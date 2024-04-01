import data from "./data.json";
fetch('data.json')
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    const name=data.name;
    console.log(name); 
    document.getElementById("main").innerHTML=`<p>Name:${data.name}<p>`
  })
  .catch(error => {
    console.error('There was a problem with your fetch operation:', error);
  });
