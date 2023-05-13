const table = document.getElementById('csv-table');

fetch('contacts_to_import.csv')
  .then(response => response.text())
  .then(data => {
    const rows = data.split('\n');

    for (let i = 0; i < rows.length; i++) {
      const cells = rows[i].split(',');
      const row = table.insertRow();

      for (let j = 0; j < cells.length; j++) {
        const cell = row.insertCell();
        cell.innerText = cells[j];
      }
    }
  });
