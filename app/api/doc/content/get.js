const showLogout = () => `
<div>
    <h2>Get users</h2>
    <i class="task-desc">Nové uživatele telegram botu</i>
    <div class="method">
    <span class="method-get">GET</span><b>/user</b>
    </div>
    <div class="desc-block desc-block-header header-param">
        <h3>Headers:</h3>
        <p>Authorization:<span>*</span>Bearer &#60;token&#62;</p>
    </div>
    <div class="desc-block response-block">
        <h3>Response:</h3>
        <b>1. Get users</b> 
        <h4 class="status-header">Status:</h4><i class="status status-success">200 Success</i>
        <code>
        {
            "id": 793314390,
            "first_name": "Shakhmatov",
            "last_name": "Anton",
            "type": "private"
        }
        </code>  
    <b>2. Authentication failed</b>
    <h4 class="status-header">Status:</h4><i class="status status-unsuccess">401 Unauthorized</i> 
<code>
        {
        "message": "Unauthorized"
        {
</code>
    </div>
</div>
`;