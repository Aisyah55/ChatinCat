const searchBox = document.querySelector("#searchBox"),
clearBtn = document.querySelector("#clearBtn"),
usersList = document.querySelector(".users-list");

searchBox.onkeyup = ()=>{
    let searchTerm = searchBox.value;
    if(searchTerm != ""){
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../chat/ambil.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
                usersList.innerHTML = xhr.response;
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("searchTerm=" + searchTerm);
    } else {
        loadUsers();
    }
};

clearBtn.onclick = ()=>{
    searchBox.value = "";
    loadUsers();
};

function loadUsers(){
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../chat/ambil.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
            usersList.innerHTML = xhr.response;
        }
    }
    xhr.send();
}

setInterval(loadUsers, 1000);
