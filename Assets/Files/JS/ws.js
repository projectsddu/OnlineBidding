

  window.onload=function(){
    document.getElementById("plus").addEventListener("click", function() {
        var cur_bid=document.getElementById("cur_bid").innerText;
        cur_bid=parseInt(cur_bid)
        // cur_bid.innerText=String(Math.round(cur_bid+cur_bid*0.1));
        // cur_bid.innerHTML="pop";
        document.getElementById("cur_bid").innerText=String(Math.round(cur_bid+cur_bid*0.1));
        console.log(typeof(String(Math.round(cur_bid+cur_bid*0.1))));
      });
      document.getElementById("minus").addEventListener("click", function() {
          console.log("skcajasjkasj")
        var cur_bid=document.getElementById("cur_bid").innerText;
        cur_bid=parseInt(cur_bid)
        var base_price=parseInt(document.getElementById("base_p").innerText);
        if(cur_bid<base_price)
        {
            document.getElementById("cur_bid").innerText=String(Math.round(cur_bid-cur_bid*0.1));
            console.log(typeof(String(Math.round(cur_bid+cur_bid*0.1))));
        }
        else
        {
            
        }

        // cur_bid.innerText=String(Math.round(cur_bid+cur_bid*0.1));
        // cur_bid.innerHTML="pop";
        
      });
    
  }