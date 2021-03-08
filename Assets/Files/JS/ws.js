$(document).ready(function () {

    
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

        location.reload();
      
    })
      
  }
)