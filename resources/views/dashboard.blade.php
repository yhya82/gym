

<div>
    <div >
        <div>
            <p>Total Revenue</p>
            <p id="total_revenue"></p>
        </div>
        <div>
            <p>Monthly Revenue</p>
            <p id ='monthly_revenue'></p>
        </div>
        <div>
            <p>Total Members</p>
            <p id='total_members'></p>
        </div>
        <div>
            <p>Active Members</p>
            <p id="active_members"></p>
        </div>
        <div>
            <p>Expired Members</p>
            <p id="expired_members"></p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){

        fetch(`/api/dashboard`)
        .then(res => res.json())
        .then(data => {

            document.getElementById('total_revenue').innerText = data.total_revenue;
            document.getElementById('monthly_revenue').innerText = data.monthly_revenue;
            document.getElementById('total_members').innerText = data.total_members;
            document.getElementById('active_members').innerText = data.active_members;
            document.getElementById('expired_members').innerText = data.expired_members;

        })

        .catch(err => console.error(err));
    })
</script>