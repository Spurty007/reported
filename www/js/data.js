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
    var t1=document.forms["ssrt"]["T1"].value;
    var t2=document.forms["ssrt"]["T2"].value;
    var s1=document.forms["ssrt"]["S1"].value;
    var s2=document.forms["ssrt"]["S2"].value;
    var obj={};
    obj["Subject"] = t2 + " vs " + t1;
    obj["Report"] = t2 + ":" + s2 + "\n" + t1 + ":"+  s1;
    document.getElementById("posted").innerHTML = "<pre>Report:\n" + 
        t2 + ":" + s2 + " vs " + t1 + ":" +  s1 + 
        "\nwas successfully mailed\nThank you!</pre>";
    SendToStatistician(obj);
}

function SendToStatistician(content) {
    var send = function(content, success) {
        var xhr = new XMLHttpRequest();
        xhr.addEventListener('load', success);
        xhr.open("POST", "post.php");
        xhr.setRequestHeader('content-type', 'application/json');
        xhr.send(JSON.stringify(content));
    };   
    send(content,function(){
        const form = document.forms["ssrt"];
        form.reset();
    });
}
