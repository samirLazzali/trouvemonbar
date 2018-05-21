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
    offer boolean,
    op integer NOT NULL,
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
-- Name: links; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.links (
    aid integer NOT NULL,
    tid integer NOT NULL
);


ALTER TABLE public.links OWNER TO ensiie;

--
-- Name: tags; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.tags (
    id integer NOT NULL,
    name character varying(20) NOT NULL
);


ALTER TABLE public.tags OWNER TO ensiie;

--
-- Name: tags_id_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.tags_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tags_id_seq OWNER TO ensiie;

--
-- Name: tags_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.tags_id_seq OWNED BY public.tags.id;


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
-- Name: tags id; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.tags ALTER COLUMN id SET DEFAULT nextval('public.tags_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: annonce; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.annonce (id, postdate, offer, op, semestre, module, genre, titre, description, paiement, service, answered) FROM stdin;
2	2018-05-21 17:20:02	f	5	2	PWR	PHP, CSS, HTML	Projet de Web	C'est trop dur j'ai besoin d'un site tout fait !	0	Un poste à Dièse	f
4	2018-05-21 17:47:57	t	1	2	IPFL	Caml, Fonctionnel	Projet IPF	J'ai un projet sur les bras, quelqu'un en veut ?	0	4 Kebabs	f
5	2018-05-21 17:55:27	f	3	2	LVFH2	Anglais, FH	Acteur	On cherche un acteur pour la vidéo d'anglais, quelqu'un est chaud ?	0		f
3	2018-05-21 17:46:09	f	6	2	ILO	Objet, Java	Aide TP ILO	Comment on remplit ClientFrame2 ?	20		f
7	2018-05-21 20:38:13	f	2	2	NULL	Stage, été	Stage	Je cherche un stage pour l'été 2018, quelqu'un a un piston ?	550		f
6	2018-05-21 18:11:18	f	6	2	LVFH2	LV2, tacos	DM d'espagnol	Quelqu'un peut me faire le DM d'espagnol je sais pas parler :(	10		f
\.


--
-- Data for Name: links; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.links (aid, tid) FROM stdin;
2	2
2	3
5	6
5	7
7	10
7	11
\.


--
-- Data for Name: tags; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.tags (id, name) FROM stdin;
2	#diese
3	#pls
4	#chat
5	#cdur
6	#video
7	#MCU
8	#real
9	#spanish
10	#stage
11	#remunere
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.users (id, email, username, password, admin) FROM stdin;
2	yassir.chekour@ensiie.fr	Yassir	098f6bcd4621d373cade4e832627b4f6	t
3	victor.meas@ensiie.fr	Vicky	098f6bcd4621d373cade4e832627b4f6	t
4	hugo.trachino@ensiie.fr	Nuja	098f6bcd4621d373cade4e832627b4f6	t
5	paul.thibaud@ensiie.fr	Paul Thibaud	098f6bcd4621d373cade4e832627b4f6	f
6	thomas.gubeno@ensiie.fr	Thomas Gubeno	2c8d2ade2786f1b74106290e8425d8e6	f
1	jean-baptiste.skutnik@ensiie.fr	Spoutnik	ad91e74f45b505957c676f7fc9410127	t
\.


--
-- Name: annonce_id_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.annonce_id_seq', 7, true);


--
-- Name: tags_id_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.tags_id_seq', 11, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.users_id_seq', 10, true);


--
-- Name: annonce annonce_id_key; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.annonce
    ADD CONSTRAINT annonce_id_key UNIQUE (id);


--
-- Name: tags tags_id_key; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.tags
    ADD CONSTRAINT tags_id_key UNIQUE (id);


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
-- Name: links fk_tag_id; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.links
    ADD CONSTRAINT fk_tag_id FOREIGN KEY (tid) REFERENCES public.tags(id);


--
-- Name: links fk_tagged_annonce; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.links
    ADD CONSTRAINT fk_tagged_annonce FOREIGN KEY (aid) REFERENCES public.annonce(id);


--
-- PostgreSQL database dump complete
--

