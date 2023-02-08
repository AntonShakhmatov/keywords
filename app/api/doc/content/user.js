const showSession = () => `
<div>
    <h2>User</h2>
    <i class="task-desc">
    Přidat nového uživatele. Uživatel může přidávat nové kontakty do databáze.</i>
    <div class="method"><span class="method-post">POST</span><b>/user</b></div>
    <div class="desc-block desc-block-header">
        <h3>Headers:</h3>
        <p>Content-Type: application/json</p>
    </div>
    <div class="desc-block desc-block-header">
        <h3>Body:</h3>
        <div class="header-param">
            <h4>login</h4><span>*</span>
        </div>
        <div class="header-param">
            <h4>password</h4><span>*</span>
        </div>
        <code>
        {
            "login": "Anton",
            "password": "123"
        }
        </code> 
        </div>
    </div>
    <div class="desc-block response-block">
        <h3>Response:</h3>
        <b>1. Relace byla úspěšně vytvořena. Přidáno do databáze</b> 
        <h4 class="status-header">Status:</h4><i class="status status-success">200 Success</i>  
<code>
        {
            "login": "Anton",
            "password": "123"
        }
</code> 
    <b>2. Bad Request</b>
    <h4 class="status-header">Status:</h4><i class="status status-unsuccess">400 Bad Request</i> 
<code>
    {
        "message": "Unauthorized"
    {
</code>
    <b>3. Unique login</b>
    <h4 class="status-header">Status:</h4><i class="status status-unsuccess">303 Already exist</i>
    <code>
    {
        "message": "Already exist"
    {
    </code>
        </div>
    </div>`;
