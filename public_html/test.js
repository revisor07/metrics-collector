
fetch('connections.json')
.then(response => response.json())
.then(data => {
    connection_data = data;
})
.catch(error => console.error('Error loading connections.json:', error));
console.log("SNAKE", connection_data)