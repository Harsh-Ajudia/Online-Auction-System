<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>jQuery Credit Card Validator Example</title>
	<script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="card/j/jquery.creditCardValidator.js"></script>
</head>
<body>
    <label>CC number <input></label>
    <p class="log"></p>
	
</body>

<script>
    $(function() {
        $('input').validateCreditCard(function(result) {
            $('.log').html('Card type: ' + (result.card_type == null ? '-' : result.card_type.name)
                     + '<br>Valid: ' + result.valid
                     + '<br>Length valid: ' + result.length_valid
                     + '<br>Luhn valid: ' + result.luhn_valid);
        });
    });
</script>
</html>
