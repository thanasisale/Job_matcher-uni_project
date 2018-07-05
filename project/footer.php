
      <script type="text/javascript">
        // Input adding function
        function addInput() {
          $('#inputs').append('<input type="text" name="skills[]">');
        }
        function addInputlang() {
          $('#inputslang').append('<input type="text" name="languages[]">');
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
    </body>
</html>
<?php mysqli_close($mysqli); ?>
