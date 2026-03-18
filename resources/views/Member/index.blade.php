<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Members List</h2>

    <a href="{{route('members.create')}}">Create new member</a>

    <div>
        <input type="search" id="searchInput">
        <select name="plan_id" id="planSelect">
            <option value="">All</option>
                @foreach($plans as $plan)
            <option value="{{$plan->id}}">{{$plan->name}}</option>
            @endforeach
        </select>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Join Date</th>
                <th>Plan</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Action</th>
             </tr>
        </thead>
        <tbody id="tbody"></tbody>
            
    </table>
<script>
      const searchInput = document.getElementById('searchInput');
      const planSelect = document.getElementById('planSelect');

      function loadmembers(){
            const search = searchInput.value;
            const plan =planSelect.value;

            fetch(`/api/members?search=${search}&plan_id=${plan}`)
            .then(res => res.json())
            .then(response =>{
                    const members = response.data;

                    const tbody = document.getElementById('tbody');
                    tbody.innerHTML='';

                        if(members.length === 0){
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
                            <td>${member.payment && member.payment.plan? member.payment.plan.name : ''}</td>
                            <td>${member.payment? member.payment.amount: '' }</td>
                            <td>${member.payment ? member.payment.payment_method: ''}</td>
                            <td>${member.status}</td>
                            <td>
                                <a href="/members/${member.id}/edit">Edit</a>
                                <a href="/members/${member.id}/renew">Renew</a>
                                <button onclick="deleteMember(${member.id})">Delete</button>
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
            headers:{'Accept':'Application/json',}
        })
        .then(res => res.json())
        .then(res => {
            alert(res.message);
            loadmembers();
      })
      .catch(err => console.error(err));
    }
   </script> 
</body>
</html>