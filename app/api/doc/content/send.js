const showEditProfile = () => `
<div>
    <h2>Send the message</h2>
    <i class="task-desc">Poslat text do skupiny</i>
    <div class="method">
        <span class="method-post">POST</span><b>/sender</b>
    </div>
    <div class="desc-block desc-block-header header-param">
    <h3>Headers:</h3>
    <p>Authorization:<span>*</span>Bearer &#60;token&#62;</p>
    </div>
    <div class="desc-block request-block">
        <h3>Request:</h3>
        <b>1. Send your text to telegram</b>    

        <div class="desc-block desc-block-header">
        <h3>Body:</h3>
        <div class="header-param">
        <h4>Zadejte svůj text</h4>
        </div>
        <code>
        {
            "text": "Zde zadej svou zprávu"
        }
        </code> 
        </div>
    </div>

    <b>1. Zpráva byla odeslána</b><br>
    <h4 class="status-header">Status:</h4><i class="status status-success">200 Success</i>  
    <code>
    {
        "text": "Zde zadej svou zprávu"
    }
    </code>    
    <b>2. Incorrect data</b><br>
    <h4 class="status-header">Status:</h4><i class="status status-unsuccess">400 input data incorrect</i> 
    <code>
    {
        "message": "Bad Request"
    {
    </code>
    <b>3. Authentication failed</b>
    <h4 class="status-header">Status:</h4><i class="status status-unsuccess">401 Unauthorized</i> 
    <code>
        {
        "message": "Unauthorized"
        {
    </code>
    </div>
    </div>`;
