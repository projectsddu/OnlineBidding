$(document).ready(function () {
  var conn = new WebSocket('ws://localhost:8080');
  conn.onopen = function(e) {
      console.log("Connection established!");
  };
  
  conn.onmessage = function(e) {
      console.log(e.data);
  };
  var data={
    "type":"connection",
    "pid":34,
    "uid":100
}
setTimeout(()=>{


    conn.send(JSON.stringify(data));
    console.log("Data send")
},200)
    $("#plus").click(function(){    
      
      console.log("jenil");
        var incr=parseInt(document.getElementById("cur_bid").innerText);
        incr=incr+1
        var base_p=parseInt(document.getElementById("curr_bid").innerText);
        if(base_p ==0)
        {
          return;
        }
        else
        {

        
        document.getElementById("cur_bid").innerText=String(incr)+"%";
        var price=(incr/100)*base_p+base_p;
        console.log(price);
        document.getElementById("current_bid").innerText=String(price);
        }
      });
      
      
          
        $("#minus").click(function(){
        console.log("penil")

        var incr=parseInt(document.getElementById("cur_bid").innerText);
        if(incr>10)
        {
          incr=incr-1
          document.getElementById("cur_bid").innerText=String(incr)+"%";
          var base_p=parseInt(document.getElementById("cur_bid").innerText);
        document.getElementById("cur_bid").innerText=String(incr)+"%";
        
        var price=parseInt(document.getElementById("curr_bid").innerText);
        price=price+(incr/100)*price;
        document.getElementById("current_bid").innerText=String(price)
        }
        else
        {
          console.log("Cannot decrease bid with 10%");
        }
      });
      
      $("#place_bid").click(function(){
        alert("Do you want to place bid")
        // make an ajax call from here to the websocket 
        const queryString=window.location.search;
        const urlParam=new URLSearchParams(queryString);
        console.log(urlParam.get("id"));
        // console.log(queryString);
        var data1={
           "type":"bidupdate",
          "pid":urlParam.get("id"),
          "uid":document.getElementById(""),
          
      }       
        // location.reload();
      
    })
      
  }
)