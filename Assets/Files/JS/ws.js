

  window.onload=function(){
    document.getElementById("plus").addEventListener("click", function() {
        console.log("jenil");
        var incr=parseInt(document.getElementById("cur_bid").innerText);
        incr=incr+1
        document.getElementById("cur_bid").innerText=String(incr)+"%";

      });
      document.getElementById("minus").addEventListener("click", function() {
          console.log("penil")

        var incr=parseInt(document.getElementById("cur_bid").innerText);
        if(incr>10)
        {
          incr=incr-1
        document.getElementById("cur_bid").innerText=String(incr)+"%";
        }
        else
        {
          console.log("Cannot decrease bid with 10%");
        }
      });
      
  }