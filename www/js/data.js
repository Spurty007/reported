function Data() {
    let update="";
    let jdata = [['Town','#T1'],['Team','#T2'],['Score','#S1'],['Score','#S2']];
    jdata.forEach((jdata) => { 
        let chunk='<script>$(function() {var $dropdown = $(this); $.getJSON("data/'+jdata[0]+'.json", function(data) {var key = \''+jdata[0]+'\'; var vals = []; vals = data.'+jdata[0]+'.split(","); var $'+jdata[0]+' = $("'+jdata[1]+'");$'+jdata[0]+'.empty();$.each(vals, function(index, value) {$'+jdata[0]+'.append("<option>" + value + "<\/option>");});});})</script>';
        update=update+chunk;
    });
    $("#Refactor").replaceWith(update);
}

function Validate() {
    if (document.forms["ssrt"]["T1"].value == "") { alert("Town name must be filled out"); return false; }
    if (document.forms["ssrt"]["T2"].value == "") { alert("Team name must be filled out"); return false; }
    if (document.forms["ssrt"]["S1"].value == "") { alert("Score for Opponent not selected"); return false; }
    if (document.forms["ssrt"]["S2"].value == "") { alert("Score for Town not selected"); return false; }
    const date = new Date();
    var logiday=date.getFullYear() + '-' + date.getMonth() + '-' +date.getDate();
    var logitime=date.getHours() + ':' + date.getMinutes() + ':' +date.getSeconds();
    var obj={Time:logitime,Day:logiday};
    obj[document.forms["ssrt"]["T1"].value] =  document.forms["ssrt"]["S1"].value;
    obj[document.forms["ssrt"]["T2"].value] =  document.forms["ssrt"]["S2"].value;
    document.getElementById("posted").innerHTML = "<pre>\n"+JSON.stringify((obj), undefined, 4)+"</pre>";
    SendToStatistician(obj);
}

function SendToStatistician(content) {
    console.log('Mail sent on '+ content.Day + '@'+ content.Time);  
    var send = function(content, success) {
        var xhr = new XMLHttpRequest();
        xhr.addEventListener('load', success);
        xhr.open("POST", "post.php");
        xhr.setRequestHeader('content-type', 'application/json');
        xhr.send(JSON.stringify(content));
    };
    send(content,function(){
        console.log(this.responseText);
    });

}