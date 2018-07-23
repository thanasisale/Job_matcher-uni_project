
      <!-- Script to add or remove input fields -->
      <script type="text/javascript">
        // Input adding function
        function addInput() {
          $('#inputs').append('<input type="text" name="skills[]" class="form-control" id="skills" placeholder="Enter a skill">');
        }
        function addInputlang() {
          $('#inputslang').append('<input type="text" name="languages[]" class="form-control" id="lang" placeholder="Enter a language">');
        }
        function removeskillInput() {
          $('#inputs input').remove('input:last-child');
        }
        function removelangInput() {
          $('#inputslang input').remove('input:last-child');
        }


        // Event handler and the first input
        $(document).ready(function () {
          $('#adder').click(addInput);
          //addInput();
          $('#adderlang').click(addInputlang);
          //addInputlang();
          $('#remove').click(removeskillInput);
          $('#removelang').click(removelangInput);

        });
      </script>
      <!-- Including the js for bootstrap -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
    </html>
    <?php mysqli_close($mysqli); //Closing the connection with the DB ?>
