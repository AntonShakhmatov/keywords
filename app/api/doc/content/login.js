const showProfile = () => `
<div>
    <h2>Login</h2>
    <i class="task-desc">Token pro uživatele</i>
    <div class="method">
        <span class="method-post">POST</span><b>/auth/login</b>
    </div>
    <div class="desc-block request-block">
        <h3>Request:</h3>
        <b>1. Post uživatelská data</b> 

        <div class="desc-block desc-block-header">
        <h3>Body:</h3>
        <div class="header-param">
        <h4>login</h4>
        </div>
        <div class="header-param">
            <h4>password</h4>
        </div>
        <code>
        {
            "login": "Anton",
            "password": "123"
        }
        </code> 
        </div>
    </div>

    <b>1. Jste přihlášeni</b><br>
    <h4 class="status-header">Status:</h4><i class="status status-success">200 Success</i>  
    <code>
    {

    "token": "ac1722c07a9fe7cc0e0f746d1ce5f11199d415266050425112cae7a970d26d79"

    }
    </code>    
    <b>2. Incorrect data</b><br>
    <h4 class="status-header">Status:</h4><i class="status status-unsuccess">400 Bad request</i> 
    <code>
    {
    "message": "Bad Request"
    {
    </code>
    <b>2. Authentication failed</b>
    <h4 class="status-header">Status:</h4><i class="status status-unsuccess">401 Unauthorized</i> 
    <code>
        {
        "message": "Unauthorized"
        {
    </code>
    </div>
    </div>`;