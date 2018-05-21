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
1	2018-05-19 17:01:06	\N	2	2	MST	Statistiques	Projet Math	Besoin de partenaire urgent !!!	400		f
\.


--
-- Data for Name: links; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.links (aid, tid) FROM stdin;
\.


--
-- Data for Name: tags; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.tags (id, name) FROM stdin;
1	test
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.users (id, email, username, password, admin) FROM stdin;
1	jean-baptiste.skutnik@ensiie.fr	Spoutnik	dacae7562117be083f8ec98f3e56f690	t
2	yassir.chekour@ensiie.fr	Yassir	098f6bcd4621d373cade4e832627b4f6	t
3	victor.meas@ensiie.fr	Vicky	098f6bcd4621d373cade4e832627b4f6	t
4	hugo.trachino@ensiie.fr	Nuja	098f6bcd4621d373cade4e832627b4f6	t
\.


--
-- Name: annonce_id_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.annonce_id_seq', 1, true);


--
-- Name: tags_id_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.tags_id_seq', 1, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.users_id_seq', 8, true);


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

