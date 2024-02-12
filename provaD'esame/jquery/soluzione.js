document.addEventListener("DOMContentLoaded", () =>{

    const matrix = generateMatrix(6,7);

    populateTab(matrix);

});

function generateMatrix(rows, cols) {
    const matrix = [];

    for (let i = 0; i<rows; i++){
        matrix[i] = [];
        for (let j = 0; j<cols; j++){
            matrix[i][j] = Math.floor(Math.random()*2)+1;
        }
    }
    return matrix;
}

function populateTab(matrix){
    let tabel = document.querySelector("table");

    for (let i = 0; i<matrix.length; i++){
        const row = tabel.insertRow(-1);
        for (let j = 0; j<matrix[i].length; j++){
            const cell = row.insertCell(-1);
            cell.textContent = matrix[i][j];

            if(matrix[i][j] === 1){
                cell.style.backgroundColor = "red";
            } else {
                cell.style.backgroundColor = "blue";
            }
        }
    }
}