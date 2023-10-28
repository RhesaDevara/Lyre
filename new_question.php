<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="mb-3">
    <input type="checkbox" id="toggleCheckbox"> Buat soal untuk tes online
        <div id="hiddenText" style="display:none;"><center>
        <script>
        function generateQuestions() {
            var jumlah_pertanyaan = parseInt(document.getElementById('jumlah_pertanyaan').value);
            var table = document.getElementById('questionTable');
            var html = '';

            for (var i = 1; i <= jumlah_pertanyaan; i++) {
                html += `
                <tr>
                    <td> <b> No.${i} </td>
                    <td> : </td>
                    <td colspan=4> <input type="text" class="form-control" name="soalno${i}" required> </td>
                </tr>
                <tr>
                    <td rowspan=4> Pilihan </td>
                    <td rowspan=4> : </td>
                    <td> <label><input type="radio" name="pgno${i}" class="mt-3" value="A"> A <input type="text" class="form-control mb-4" name="a${i}" required> </label></td>
                </tr>
                <tr>
                    <td> <label><input type="radio" name="pgno${i}" class="mt-3" value="B"> B <input type="text" class="form-control mb-4" name="b${i}" required></label></td>
                </tr>
                <tr>
                    <td> <label><input type="radio" name="pgno${i}" class="mt-3" value="C"> C <input type="text" class="form-control mb-4" name="c${i}" required></label></td>
                </tr>
                <tr>
                    <td> <label><input type="radio" name="pgno${i}" class="mt-3" value="D"> D <input type="text" class="form-control mb-4" name="d${i}" required></label></td>
                </tr>
                <tr>
                    <td colspan=8> <hr> </td>
                </tr>`;
            }

            table.innerHTML = html;
        }
    </script>
    <table width=75% border=0 id="questionTable">
        <tr>
            <th colspan=8> <center> <h4>Soal</h4> </th>
        </tr>
    </table>
    
    <label for="jumlah_pertanyaan">Jumlah Soal:</label>
    <input type="number" id="jumlah_pertanyaan" name="jumlah_pertanyaan" min="1" value="1">
    <button onclick="generateQuestions()">Buat Soal</button>
    </div>
    <script src="script.js"></script>
    </div>
</body>
</html>