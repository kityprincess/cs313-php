<fieldset class="row2">
            <legend>Ingredients</legend>
            <input type="button" value="Add Ingredient" onClick="addRow('ingTable')" />
            <input type="button" value="Remove Ingredient" onClick="deleteRow('ingTable')" />    
            <table id="ingTable" class="form" border="1">
              <tbody>
                <?php foreach ($jing AS $ing) {
                echo '<tr>';
                  echo '<td><input type="checkbox" required="required" name="chk[]" checked="checked" />';
                  echo '</td>';
                  echo '<td><input type="number" min="0" name="qty[]" id="qty" value="<?php echo htmlspecialchars($ing['qty']); ?>">';
                  echo '</td>';
                  echo '<td><input type="text" name="unit[]" id="unit" value="<?php echo htmlspecialchars($ing['unit']); ?>">';
                  echo '</td>';
                  echo '<td><input type="text" name="ingredient[]" id="ingredient" value="<?php echo htmlspecialchars($ing['ingredient']); ?>">';
                  echo '</td>';
                echo '</tr>';
              } ?>
              </tbody>
            </table>
          </fieldset>


          <fieldset class="row1">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($rDetails['recipe'][0]['name']); ?>">
            <label for="category">Category:</label>
            <input type="text" name="category" id="category" value="<?php echo htmlspecialchars($rDetails['recipe'][0]['category']); ?>">
            <input type="text" name="recipe_id" id="recipe_id" value="<?php echo htmlspecialchars($id); ?>">
          </fieldset>

          <fieldset class="row3">
            <legend>Instructions</legend>
            <label for="Instructions">Put each step on its own line</label>
            <textarea name="instructions"><?php 
              foreach ($jins as $part) {
                echo $part . '\n';
              }; ?></textarea>
          </fieldset>