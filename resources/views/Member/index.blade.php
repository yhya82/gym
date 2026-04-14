
    @extends('layouts.app')
    @section('content')
    <div class="flex flex-col mt-16 px-2 ">
    <h2 class="text-4xl lg:text-6xl font-serif">Members List</h2>
    <a href="{{route('members.web.create')}}" class="text-2xl lg:text-3xl text-blue-600 hover:text-blue-400">Create new member</a>
    </div>
    <div class="px-2 mt-4 lg:mt-6">
        <input type="search" id="searchInput" placeholder="Search by name and phone" class="w-1/2 lg:w-1/4 placeholder:text-xl placeholder:lg:text-xl">
        <select name="plan_id" id="planSelect" >
            <option value="">All</option>
                @foreach($plans as $plan)
            <option value="{{$plan->id}}">{{$plan->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="overflow-x-auto mt-4 px-2">
    <table class ="min-w-max border border-gray-700 ">
        <thead class="bg-blue-900 text-2xl lg:text-3xl  text-white ">
            <tr>
                <th class="p-3 lg:p-5 gap-4">ID</th>
                <th class="p-3 lg:p-5 gap-4">Name</th>
                <th class="p-3 lg:p-5 gap-2">Phone</th>
                <th class="p-3 lg:p-5 gap-4">Gender</th>
                <th class="p-3 lg:p-5 gap-4">Join Date</th>
                <th class="p-3 lg:p-5 gap-4">Plan(Days)</th>
                <th class="p-3 lg:p-5 gap-4">Plan Price</th>
                <th class="p-3 lg:p-5 gap-4">Amount</th>
                <th class="p-3 lg:p-5 gap-4">Payment Method</th>
                <th class="p-3 lg:p-5 gap-4">Start Date</th>
                <th class="p-3 lg:p-5 gap-4">End Date</th>
                <th class="p-3 lg:p-5 gap-4">User</th>
                <th class="p-3 lg:p-5 gap-4">Status</th>
                <th class="p-3 lg:p-5 gap-4">Action</th>
             </tr>
        </thead>
        <tbody id="tbody" class="text-center text-xl lg:text-2xl border border-gray-600"></tbody>
            
    </table>
    </div>
    @endsection

    @section('scripts')
<script>
      const searchInput = document.getElementById('searchInput');
      const planSelect = document.getElementById('planSelect');

      function loadmembers(){
            const search = searchInput.value;
            const plan =planSelect.value;

            fetch(`/api/members?search=${search}&plan_id=${plan}`,{
                method:'GET',
                credentials:'include',
                headers:{
                       'Accept':'application/json' 
                }
            })
            .then(res => res.json())
            .then(response =>{
                const members = response.data;

                    const tbody = document.getElementById('tbody');
                    tbody.innerHTML='';

                        if(!members || members.length === 0){
                            tbody.innerHTML='<tr><td>No members found</td></tr>';
                            return;
                        }

                        members.forEach (member=> {

                        const tr = document.createElement('tr');

                            tr.innerHTML =`
                            <td>${member.id}</td>
                            <td>${member.name}</td>
                            <td>${member.phone}</td>
                            <td>${member.gender}</td>
                            <td>${member.join_date}</td>
                            <td>${member.plan ? member.plan.name : ''}</td>
                            <td>${member.plan ? member.plan.price : ''}</td>
                            <td>${member.payment? member.payment.amount: '' }</td>
                            <td>${member.payment ? member.payment.payment_method: ''}</td>
                            <td>${member.payment ? member.payment.start_date: ''}</td>
                            <td>${member.payment ? member.payment.expiry_date: ''}</td>
                            <td>${member.payment && member.payment.user ? member.payment.user.name : ''}</td>

                            <td class="text-green-600 font-bold">${member.status}</td>
                            <td>
                                <a href="/members/${member.id}/edit" class="text-blue-600 hover:underline">Edit</a>
                                <a href="/members/${member.id}/renew" class="text-blue-600 hover:underline">Renew</a>
                                <button onclick="deleteMember(${member.id})" class="text-blue-600 hover:underline">Delete</button>
                                </td>

                              `;
                            tbody.appendChild(tr);                       
                        });
            });

           
      }
    searchInput.addEventListener('keyup', loadmembers);
     planSelect.addEventListener('change', loadmembers);

      loadmembers();

      function deleteMember(id){
        if(!confirm ('Are you sure you want to delete member '))return;

        fetch(`/api/members/${id}`,{
            method:'DELETE',
            credentials:'include',
            headers:{'Accept':'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(res => res.json())
        .then(res => {
            alert(res.message);
            loadmembers();
      })
      .catch(err => console.error(err));
    }
   </script> 
@endsection