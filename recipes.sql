DROP TABLE public.recipe_ingredients CASCADE;
DROP TABLE public.recipe CASCADE;
DROP TABLE public.ingredients CASCADE;
DROP TABLE public.media CASCADE;

CREATE TABLE public.recipe
(id SERIAL PRIMARY KEY,
 name VARCHAR(30) NOT NULL UNIQUE,
 instructions JSONB NOT NULL,
 category VARCHAR(20));

 CREATE TABLE public.ingredients
 (id SERIAL PRIMARY KEY,
  description JSONB NOT NULL);

 CREATE TABLE public.media
 (id SERIAL PRIMARY KEY,
  recipe_id INTEGER REFERENCES public.recipe(id) ON DELETE CASCADE,
  description VARCHAR(30), 
  file BYTEA);
 
 CREATE TABLE public.recipe_ingredients
 (id SERIAL PRIMARY KEY,
  recipe_id INTEGER REFERENCES public.recipe(id) ON DELETE CASCADE,
  ingredients_id INTEGER REFERENCES public.ingredients(id) ON DELETE CASCADE);