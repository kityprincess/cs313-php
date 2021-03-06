--
-- PostgreSQL database dump
--

-- Dumped from database version 10.3 (Ubuntu 10.3-1.pgdg16.04+1)
-- Dumped by pg_dump version 10.4 (Ubuntu 10.4-1.pgdg16.04+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: category; Type: TABLE; Schema: public; Owner: hkxkcuvebevxjo
--

CREATE TABLE public.category (
    id integer NOT NULL,
    description character(25) NOT NULL
);


ALTER TABLE public.category OWNER TO hkxkcuvebevxjo;

--
-- Name: category_id_seq; Type: SEQUENCE; Schema: public; Owner: hkxkcuvebevxjo
--

CREATE SEQUENCE public.category_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.category_id_seq OWNER TO hkxkcuvebevxjo;

--
-- Name: category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER SEQUENCE public.category_id_seq OWNED BY public.category.id;


--
-- Name: ingredients; Type: TABLE; Schema: public; Owner: hkxkcuvebevxjo
--

CREATE TABLE public.ingredients (
    id integer NOT NULL,
    name character(30) NOT NULL
);


ALTER TABLE public.ingredients OWNER TO hkxkcuvebevxjo;

--
-- Name: ingredients_id_seq; Type: SEQUENCE; Schema: public; Owner: hkxkcuvebevxjo
--

CREATE SEQUENCE public.ingredients_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ingredients_id_seq OWNER TO hkxkcuvebevxjo;

--
-- Name: ingredients_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER SEQUENCE public.ingredients_id_seq OWNED BY public.ingredients.id;


--
-- Name: media; Type: TABLE; Schema: public; Owner: hkxkcuvebevxjo
--

CREATE TABLE public.media (
    id integer NOT NULL,
    recipe_id integer,
    description character(30),
    file bytea
);


ALTER TABLE public.media OWNER TO hkxkcuvebevxjo;

--
-- Name: media_id_seq; Type: SEQUENCE; Schema: public; Owner: hkxkcuvebevxjo
--

CREATE SEQUENCE public.media_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.media_id_seq OWNER TO hkxkcuvebevxjo;

--
-- Name: media_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER SEQUENCE public.media_id_seq OWNED BY public.media.id;


--
-- Name: recipe; Type: TABLE; Schema: public; Owner: hkxkcuvebevxjo
--

CREATE TABLE public.recipe (
    id integer NOT NULL,
    name character(30) NOT NULL,
    instructions character(1) NOT NULL
);


ALTER TABLE public.recipe OWNER TO hkxkcuvebevxjo;

--
-- Name: recipe_category; Type: TABLE; Schema: public; Owner: hkxkcuvebevxjo
--

CREATE TABLE public.recipe_category (
    id integer NOT NULL,
    recipe_id integer,
    category_id integer
);


ALTER TABLE public.recipe_category OWNER TO hkxkcuvebevxjo;

--
-- Name: recipe_category_id_seq; Type: SEQUENCE; Schema: public; Owner: hkxkcuvebevxjo
--

CREATE SEQUENCE public.recipe_category_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.recipe_category_id_seq OWNER TO hkxkcuvebevxjo;

--
-- Name: recipe_category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER SEQUENCE public.recipe_category_id_seq OWNED BY public.recipe_category.id;


--
-- Name: recipe_id_seq; Type: SEQUENCE; Schema: public; Owner: hkxkcuvebevxjo
--

CREATE SEQUENCE public.recipe_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.recipe_id_seq OWNER TO hkxkcuvebevxjo;

--
-- Name: recipe_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER SEQUENCE public.recipe_id_seq OWNED BY public.recipe.id;


--
-- Name: recipe_ingredients; Type: TABLE; Schema: public; Owner: hkxkcuvebevxjo
--

CREATE TABLE public.recipe_ingredients (
    id integer NOT NULL,
    recipe_id integer,
    category_id integer,
    unit_id integer,
    qty integer NOT NULL
);


ALTER TABLE public.recipe_ingredients OWNER TO hkxkcuvebevxjo;

--
-- Name: recipe_ingredients_id_seq; Type: SEQUENCE; Schema: public; Owner: hkxkcuvebevxjo
--

CREATE SEQUENCE public.recipe_ingredients_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.recipe_ingredients_id_seq OWNER TO hkxkcuvebevxjo;

--
-- Name: recipe_ingredients_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER SEQUENCE public.recipe_ingredients_id_seq OWNED BY public.recipe_ingredients.id;


--
-- Name: units; Type: TABLE; Schema: public; Owner: hkxkcuvebevxjo
--

CREATE TABLE public.units (
    id integer NOT NULL,
    description character(20),
    abbr character(5),
    CONSTRAINT xor_not_null CHECK ((((description IS NOT NULL) OR (abbr IS NOT NULL)) AND (description IS DISTINCT FROM abbr)))
);


ALTER TABLE public.units OWNER TO hkxkcuvebevxjo;

--
-- Name: units_id_seq; Type: SEQUENCE; Schema: public; Owner: hkxkcuvebevxjo
--

CREATE SEQUENCE public.units_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.units_id_seq OWNER TO hkxkcuvebevxjo;

--
-- Name: units_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER SEQUENCE public.units_id_seq OWNED BY public.units.id;


--
-- Name: category id; Type: DEFAULT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.category ALTER COLUMN id SET DEFAULT nextval('public.category_id_seq'::regclass);


--
-- Name: ingredients id; Type: DEFAULT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.ingredients ALTER COLUMN id SET DEFAULT nextval('public.ingredients_id_seq'::regclass);


--
-- Name: media id; Type: DEFAULT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.media ALTER COLUMN id SET DEFAULT nextval('public.media_id_seq'::regclass);


--
-- Name: recipe id; Type: DEFAULT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.recipe ALTER COLUMN id SET DEFAULT nextval('public.recipe_id_seq'::regclass);


--
-- Name: recipe_category id; Type: DEFAULT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.recipe_category ALTER COLUMN id SET DEFAULT nextval('public.recipe_category_id_seq'::regclass);


--
-- Name: recipe_ingredients id; Type: DEFAULT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.recipe_ingredients ALTER COLUMN id SET DEFAULT nextval('public.recipe_ingredients_id_seq'::regclass);


--
-- Name: units id; Type: DEFAULT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.units ALTER COLUMN id SET DEFAULT nextval('public.units_id_seq'::regclass);


--
-- Data for Name: category; Type: TABLE DATA; Schema: public; Owner: hkxkcuvebevxjo
--

COPY public.category (id, description) FROM stdin;
\.


--
-- Data for Name: ingredients; Type: TABLE DATA; Schema: public; Owner: hkxkcuvebevxjo
--

COPY public.ingredients (id, name) FROM stdin;
\.


--
-- Data for Name: media; Type: TABLE DATA; Schema: public; Owner: hkxkcuvebevxjo
--

COPY public.media (id, recipe_id, description, file) FROM stdin;
\.


--
-- Data for Name: recipe; Type: TABLE DATA; Schema: public; Owner: hkxkcuvebevxjo
--

COPY public.recipe (id, name, instructions) FROM stdin;
\.


--
-- Data for Name: recipe_category; Type: TABLE DATA; Schema: public; Owner: hkxkcuvebevxjo
--

COPY public.recipe_category (id, recipe_id, category_id) FROM stdin;
\.


--
-- Data for Name: recipe_ingredients; Type: TABLE DATA; Schema: public; Owner: hkxkcuvebevxjo
--

COPY public.recipe_ingredients (id, recipe_id, category_id, unit_id, qty) FROM stdin;
\.


--
-- Data for Name: units; Type: TABLE DATA; Schema: public; Owner: hkxkcuvebevxjo
--

COPY public.units (id, description, abbr) FROM stdin;
\.


--
-- Name: category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: hkxkcuvebevxjo
--

SELECT pg_catalog.setval('public.category_id_seq', 1, false);


--
-- Name: ingredients_id_seq; Type: SEQUENCE SET; Schema: public; Owner: hkxkcuvebevxjo
--

SELECT pg_catalog.setval('public.ingredients_id_seq', 1, false);


--
-- Name: media_id_seq; Type: SEQUENCE SET; Schema: public; Owner: hkxkcuvebevxjo
--

SELECT pg_catalog.setval('public.media_id_seq', 1, false);


--
-- Name: recipe_category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: hkxkcuvebevxjo
--

SELECT pg_catalog.setval('public.recipe_category_id_seq', 1, false);


--
-- Name: recipe_id_seq; Type: SEQUENCE SET; Schema: public; Owner: hkxkcuvebevxjo
--

SELECT pg_catalog.setval('public.recipe_id_seq', 1, false);


--
-- Name: recipe_ingredients_id_seq; Type: SEQUENCE SET; Schema: public; Owner: hkxkcuvebevxjo
--

SELECT pg_catalog.setval('public.recipe_ingredients_id_seq', 1, false);


--
-- Name: units_id_seq; Type: SEQUENCE SET; Schema: public; Owner: hkxkcuvebevxjo
--

SELECT pg_catalog.setval('public.units_id_seq', 1, false);


--
-- Name: category category_description_key; Type: CONSTRAINT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.category
    ADD CONSTRAINT category_description_key UNIQUE (description);


--
-- Name: category category_pkey; Type: CONSTRAINT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.category
    ADD CONSTRAINT category_pkey PRIMARY KEY (id);


--
-- Name: ingredients ingredients_name_key; Type: CONSTRAINT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.ingredients
    ADD CONSTRAINT ingredients_name_key UNIQUE (name);


--
-- Name: ingredients ingredients_pkey; Type: CONSTRAINT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.ingredients
    ADD CONSTRAINT ingredients_pkey PRIMARY KEY (id);


--
-- Name: media media_description_key; Type: CONSTRAINT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.media
    ADD CONSTRAINT media_description_key UNIQUE (description);


--
-- Name: media media_pkey; Type: CONSTRAINT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.media
    ADD CONSTRAINT media_pkey PRIMARY KEY (id);


--
-- Name: recipe_category recipe_category_pkey; Type: CONSTRAINT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.recipe_category
    ADD CONSTRAINT recipe_category_pkey PRIMARY KEY (id);


--
-- Name: recipe_ingredients recipe_ingredients_pkey; Type: CONSTRAINT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.recipe_ingredients
    ADD CONSTRAINT recipe_ingredients_pkey PRIMARY KEY (id);


--
-- Name: recipe recipe_name_key; Type: CONSTRAINT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.recipe
    ADD CONSTRAINT recipe_name_key UNIQUE (name);


--
-- Name: recipe recipe_pkey; Type: CONSTRAINT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.recipe
    ADD CONSTRAINT recipe_pkey PRIMARY KEY (id);


--
-- Name: units units_pkey; Type: CONSTRAINT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.units
    ADD CONSTRAINT units_pkey PRIMARY KEY (id);


--
-- Name: media media_recipe_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.media
    ADD CONSTRAINT media_recipe_id_fkey FOREIGN KEY (recipe_id) REFERENCES public.recipe(id);


--
-- Name: recipe_category recipe_category_category_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.recipe_category
    ADD CONSTRAINT recipe_category_category_id_fkey FOREIGN KEY (category_id) REFERENCES public.category(id);


--
-- Name: recipe_category recipe_category_recipe_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.recipe_category
    ADD CONSTRAINT recipe_category_recipe_id_fkey FOREIGN KEY (recipe_id) REFERENCES public.recipe(id);


--
-- Name: recipe_ingredients recipe_ingredients_category_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.recipe_ingredients
    ADD CONSTRAINT recipe_ingredients_category_id_fkey FOREIGN KEY (category_id) REFERENCES public.category(id);


--
-- Name: recipe_ingredients recipe_ingredients_recipe_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.recipe_ingredients
    ADD CONSTRAINT recipe_ingredients_recipe_id_fkey FOREIGN KEY (recipe_id) REFERENCES public.recipe(id);


--
-- Name: recipe_ingredients recipe_ingredients_unit_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: hkxkcuvebevxjo
--

ALTER TABLE ONLY public.recipe_ingredients
    ADD CONSTRAINT recipe_ingredients_unit_id_fkey FOREIGN KEY (unit_id) REFERENCES public.units(id);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: hkxkcuvebevxjo
--

REVOKE ALL ON SCHEMA public FROM postgres;
REVOKE ALL ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO hkxkcuvebevxjo;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- Name: LANGUAGE plpgsql; Type: ACL; Schema: -; Owner: postgres
--

GRANT ALL ON LANGUAGE plpgsql TO hkxkcuvebevxjo;


--
-- PostgreSQL database dump complete
--

