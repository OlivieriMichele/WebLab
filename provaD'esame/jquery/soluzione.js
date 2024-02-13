document.addEventListener("DOMContentLoaded", () =>{

    const button = document.querySelector("button");
    const matrix = generateMatrix(6,7);
    let table = document.querySelector("table");

    populateTab(matrix, table);

    button.addEventListener('click', () => {
        generateCopy(matrix);
    })

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

function populateTab(matrix, table){

    for (let i = 0; i<matrix.length; i++){
        const row = table.insertRow(-1);
        for (let j = 0; j<matrix[i].length; j++){
            const cell = row.insertCell(-1);
            cell.textContent = matrix[i][j];

            if (matrix[i][j] === 1){
                cell.style.backgroundColor = "red";
            } else {
                cell.style.backgroundColor = "blue";
            }

            cell.addEventListener('click', () =>{
                cell.style.backgroundColor = cell.parentNode.style.backgroundColor;
                matrix[i][j] = 0;
            });
        }
    }
}

function generateCopy(matrix){

    let copyTable = document.querySelector(".copia table");
    copyTable.innerHTML = '';

    for (let i = 0; i < matrix.length; i++){
        const row = copyTable.insertRow(-1);
        for (let j = 0; j < matrix[i].length; j++){
            const cell = row.insertCell(-1);
            cell.textContent = matrix[i][j];
        }
    }

}