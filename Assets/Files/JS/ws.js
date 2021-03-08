

  window.onload=function(){
    document.getElementById("plus").addEventListener("click", function() {
        console.log("jenil");
        var incr=parseInt(document.getElementById("cur_bid").innerText);
        incr=incr+1
        var base_p=parseInt(document.getElementById("curr_bid").innerText);
        document.getElementById("cur_bid").innerText=String(incr)+"%";
        var price=(incr/100)*base_p+base_p;
        console.log(price);
        document.getElementById("current_bid").innerText=String(price);
        
      });
      document.getElementById("minus").addEventListener("click", function() {
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
      
  }