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
-- Name: user; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    firstname character varying NOT NULL,
    lastname character varying NOT NULL,
    birthday date
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
-- Name: users; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.users (
    id integer DEFAULT nextval('public.user_id_seq'::regclass) NOT NULL,
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
-- Name: user id; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public."user" (id, firstname, lastname, birthday) FROM stdin;
1	John	Doe	1967-11-22
2	Yvette	Angel	1932-01-24
3	Amelia	Waters	1981-12-01
4	Manuel	Holloway	1979-07-25
5	Alonzo	Erickson	1947-11-13
6	Otis	Roberson	1995-01-09
7	Jaime	King	1924-05-30
8	Vicky	Pearson	1982-12-12
9	Silvia	Mcguire	1971-03-02
10	Brendan	Pena	1950-02-17
11	Jackie	Cohen	1967-01-27
12	Delores	Williamson	1961-07-19
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.users (id, email, username, password, admin) FROM stdin;
0	jean-baptiste.skutnik@ensiie.fr	Spoutnik	dacae7562117be083f8ec98f3e56f690	t
\.


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.user_id_seq', 12, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.users_id_seq', 1, false);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


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
-- PostgreSQL database dump complete
--

