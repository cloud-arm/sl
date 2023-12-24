window.onload = function() {
    cloudSync();
};

function cloudSync() {
const xhr = new XMLHttpRequest();
xhr.open("GET", "sync/customer_sync.php");
xhr.send();
xhr.responseType = "json";
xhr.onload = () => {
  if (xhr.status == 200) {
   
   if( xhr.response['action']=='save'){
    document.getElementById("sync_count").innerHTML=xhr.response['count'];
    cloudSync2();
   }
    
  } else {
    console.log(`Error: ${xhr.status}`);
  }
};
}


function cloudSync2() {
const xhr = new XMLHttpRequest();
xhr.open("GET", "sync/customer_sync.php");
xhr.send();
xhr.responseType = "json";
xhr.onload = () => {
  if (xhr.status == 200) {
    
    if( xhr.response['action']=='save'){
        document.getElementById("sync_count").innerHTML=xhr.response['count'];
    cloudSync();
   }
  } else {
    console.log(`Error: ${xhr.status}`);
  }
};
}