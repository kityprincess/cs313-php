WITH ingredients_values AS (
  SELECT
    id,
    name
  FROM (
    VALUES
      (nextval('ingredients_id_seq'), 'First'),
      (nextval('ingredients_id_seq'), 'Second'),
      (nextval('ingredients_id_seq'), 'Third')
  ) AS v(id, name)
), ingredients_insert AS (
  INSERT INTO ingredients (id, name)
    SELECT
      id,
      name
    FROM ingredients_values
    ON CONFLICT (name) DO NOTHING
    RETURNING id, name
)
SELECT
  ingredients_insert.*
FROM ingredients_insert
UNION ALL
SELECT
  ingredients.id,
  ingredients.name
FROM ingredients_values
INNER JOIN ingredients
  ON ingredients_values.name = ingredients.name;