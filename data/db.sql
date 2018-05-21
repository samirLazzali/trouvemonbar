--
-- PostgreSQL database dump
--

-- Dumped from database version 10.3
-- Dumped by pg_dump version 10.3
DROP TABLE "user";
DROP TABLE "reunion";
DROP TABLE "recette";
DROP TABLE "note";
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
-- Name: user; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    prenom character varying NOT NULL,
    nom character varying NOT NULL,
    score integer NOT NULL,
    pseudo varchar(32) NOT NULL,
    mdp varchar(40) NOT NULL,
    mail varchar(100) NOT NULL,
    inscription integer NOT NULL    
);


ALTER TABLE public."user" OWNER TO ensiie;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO ensiie;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;


--
-- Name: user id; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public."user" (id, prenom, nom, score, pseudo, mdp, mail, inscription) FROM stdin;
1	Thomas	Gubeno	500	Gub	bg	tgubeno@gmail.com	2
2	Dorian	Laugier	450	Derien	lol	doriang	2
3	Simon	Lauzeral	200	SimSim	bla	blabla	2
4	Paul	Thibaud	10	Hansen	blabla	tttt	2
\.


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.user_id_seq', 12, true);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--
DROP TABLE public."Participants";
DROP TABLE public."reunion";

CREATE TABLE public."reunion"(
id_reu INTEGER PRIMARY KEY,
soiree varchar(100) NOT NULL,
cr varchar(1000) NOT NULL,
datee DATE NOT NULL
);


CREATE TABLE public."Participants"(
id_reu INTEGER NOT NULL, FOREIGN KEY (id_reu) REFERENCES public.reunion(id_reu),
pseudo VARCHAR(40) NOT NULL
);


CREATE TABLE public."recette"(
id_rec INTEGER PRIMARY KEY,
recettes varchar(100)
);

CREATE TABLE public."note"(
note INTEGER,
id_rec INTEGER,
id_vente INTEGER PRIMARY KEY,
id_usr INTEGER
);