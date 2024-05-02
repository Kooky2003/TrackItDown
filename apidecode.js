async function decode() {
    try {
        const response = await fetch('http://localhost/Project/codes/apifetch.php');
        const data = await response.json();
        console.log(data);
        AccessData(data);
    } catch (err) {
        console.error('Error:', err.message);
    }
}

function AccessData(data){
    var mandika = data[0].taskname;
    document.getElementById('sujen').innerText = mandika;

}




decode();