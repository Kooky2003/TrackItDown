function login(){
    fetch(
        `http://localhost/Project/codes/logindumb.php`
    )
    .then((res)=>res.json)
    .then((data)=>{
        console.log(data);
    })
    .catch((error) =>{
        console.log(error.message);
    })
}
login();




