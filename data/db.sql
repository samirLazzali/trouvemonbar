--
-- PostgreSQL database dump
--

-- Dumped from database version 10.3
-- Dumped by pg_dump version 10.3

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
-- Name: annonce; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.annonce (
    id integer NOT NULL,
    postdate timestamp without time zone,
    op integer,
    semestre integer,
    module character varying(20),
    genre character varying(30),
    titre character varying(100),
    description character varying(240),
    paiement integer,
    service character varying(40),
    answered boolean DEFAULT false
);


ALTER TABLE public.annonce OWNER TO ensiie;

--
-- Name: annonce_id_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.annonce_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.annonce_id_seq OWNER TO ensiie;

--
-- Name: annonce_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.annonce_id_seq OWNED BY public.annonce.id;


--
-- Name: tags; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.tags (
    name character varying(20) NOT NULL
);


ALTER TABLE public.tags OWNER TO ensiie;

--
-- Name: users; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.users (
    id integer NOT NULL,
    email character varying(40) NOT NULL,
    username character varying(20) NOT NULL,
    password character varying(32) NOT NULL,
    admin boolean DEFAULT false
);


ALTER TABLE public.users OWNER TO ensiie;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO ensiie;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: annonce id; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.annonce ALTER COLUMN id SET DEFAULT nextval('public.annonce_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: annonce; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.annonce (id, postdate, op, semestre, module, genre, titre, description, paiement, service, answered) FROM stdin;
1	2018-05-19 17:01:06	2	2	AEBI	Statistiques	Projet Math	Besoin de partenaire urgent !!!	400		f
\.


--
-- Data for Name: tags; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.tags (name) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.users (id, email, username, password, admin) FROM stdin;
1	jean-baptiste.skutnik@ensiie.fr	Spoutnik	dacae7562117be083f8ec98f3e56f690	t
2	yassir.chekour@ensiie.fr	Yassir	098f6bcd4621d373cade4e832627b4f6	t
3	victor.meas@ensiie.fr	Vicky	098f6bcd4621d373cade4e832627b4f6	t
4	hugo.trachino@ensiie.fr	Nuja	098f6bcd4621d373cade4e832627b4f6	t
5	teste	testu	testp	f
6	maria.clara@ensiie.fr	MC	098f6bcd4621d373cade4e832627b4f6	f
7	paul.thibaud@ensiie.fr		098f6bcd4621d373cade4e832627b4f6	f
8	martin.dufour@ensiie.fr	Martin Dufour	098f6bcd4621d373cade4e832627b4f6	f
\.


--
-- Name: annonce_id_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.annonce_id_seq', 1, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.users_id_seq', 8, true);


--
-- Name: tags tags_name_key; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.tags
    ADD CONSTRAINT tags_name_key UNIQUE (name);


--
-- Name: users users_id_key; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_id_key UNIQUE (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (email);


--
-- Name: annonce fk_original_poster; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.annonce
    ADD CONSTRAINT fk_original_poster FOREIGN KEY (op) REFERENCES public.users(id);


--
-- PostgreSQL database dump complete
--

