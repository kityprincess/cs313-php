<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="recipes.css"/>
    <script type="text/javascript" src="addRecipe.js"></script> 
    <title>Heirloom Recipes</title>
  </head>
  <body>
<div class = "table">
<form action="newRecipe.php" method="post">
  <h1>Add your recipe</h1>
  <fieldset class="row1">
    <label for="name">Name:</label>
    <input type="text" name="name" required="required" id="name">
    <label for="category">Category:</label>
    <input type="text" name="category" id="category">
  </fieldset>
  <fieldset class="row2">
    <legend>Ingredients</legend>
    <input type="button" value="Add Ingredient" onClick="addRow('ingTable')" />
    <input type="button" value="Remove Ingredient" onClick="deleteRow('ingTable')" />    
    <table id="ingTable" class="form" border="1">
      <tbody>
        <tr>
          <td><input type="checkbox" required="required" name="chk[]" checked="checked" />
          </td>
          <td><input type="number" min="0" name="qty[]" required="required" id="qty" placeholder="Quantity">
          </td>
          <td><input type="text" name="unit[]" required="required" id="unit" placeholder="Unit">
          </td>
          <td><input type="text" name="ingredient[]" required="required" id="ingredient" placeholder="Ingredient">
          </td>
        </tr>
      </tbody>
    </table>
  </fieldset>
  <fieldset class="row3">
    <legend>Instructions</legend>
    <label for="Instructions">Put each step on its own line</label>
    <textarea name="instructions" required="required"></textarea>
  </fieldset>
  <input class="submit" type="submit" value="Add new recipe"/>
</form>
</div>
  </body>
</html>