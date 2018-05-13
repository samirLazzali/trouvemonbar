--
-- PostgreSQL database cluster dump
--

SET default_transaction_read_only = off;

SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;

--
-- Drop databases
--

DROP DATABASE ensiie;




--
-- Drop roles
--

DROP ROLE ensiie;
DROP ROLE postgres;


--
-- Roles
--

CREATE ROLE ensiie;
ALTER ROLE ensiie WITH SUPERUSER INHERIT NOCREATEROLE NOCREATEDB LOGIN NOREPLICATION NOBYPASSRLS PASSWORD 'md55196e25d2d1a9c4c37a86d3c907a69de';
CREATE ROLE postgres;
ALTER ROLE postgres WITH SUPERUSER INHERIT CREATEROLE CREATEDB LOGIN REPLICATION BYPASSRLS;






--
-- Database creation
--

CREATE DATABASE ensiie WITH TEMPLATE = template0 OWNER = postgres;
REVOKE CONNECT,TEMPORARY ON DATABASE template1 FROM PUBLIC;
GRANT CONNECT ON DATABASE template1 TO PUBLIC;


\connect ensiie

SET default_transaction_read_only = off;

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


--
-- Name: dayofweek; Type: TYPE; Schema: public; Owner: ensiie
--

CREATE TYPE public.dayofweek AS ENUM (
    'Lundi',
    'Mardi',
    'Mercredi',
    'Jeudi',
    'Vendredi',
    'Samedi',
    'Dimanche'
);


ALTER TYPE public.dayofweek OWNER TO ensiie;

--
-- Name: hour; Type: TYPE; Schema: public; Owner: ensiie
--

CREATE TYPE public.hour AS (
	hr integer,
	min integer
);


ALTER TYPE public.hour OWNER TO ensiie;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: attachedfile; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.attachedfile (
    fileid integer NOT NULL,
    gameid integer NOT NULL
);


ALTER TABLE public.attachedfile OWNER TO ensiie;

--
-- Name: comment; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.comment (
    commentid integer NOT NULL,
    commentdate date NOT NULL,
    content text,
    gameid integer NOT NULL,
    userid integer NOT NULL
);


ALTER TABLE public.comment OWNER TO ensiie;

--
-- Name: comment_commentid_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.comment_commentid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.comment_commentid_seq OWNER TO ensiie;

--
-- Name: comment_commentid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.comment_commentid_seq OWNED BY public.comment.commentid;


--
-- Name: file; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.file (
    fileid integer NOT NULL,
    filename character varying(50) NOT NULL,
    filehash character varying(100) NOT NULL,
    private boolean DEFAULT true NOT NULL,
    extension character varying(5)
);


ALTER TABLE public.file OWNER TO ensiie;

--
-- Name: file_fileid_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.file_fileid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.file_fileid_seq OWNER TO ensiie;

--
-- Name: file_fileid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.file_fileid_seq OWNED BY public.file.fileid;


--
-- Name: game; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.game (
    gameid integer NOT NULL,
    gamename character varying(50) NOT NULL,
    gamedesc text,
    duration integer,
    private boolean DEFAULT true NOT NULL,
    gamesystemid integer NOT NULL,
    creator integer NOT NULL,
    illustration integer
);


ALTER TABLE public.game OWNER TO ensiie;

--
-- Name: COLUMN game.duration; Type: COMMENT; Schema: public; Owner: ensiie
--

COMMENT ON COLUMN public.game.duration IS 'in numbers of sessions';


--
-- Name: COLUMN game.gamesystemid; Type: COMMENT; Schema: public; Owner: ensiie
--

COMMENT ON COLUMN public.game.gamesystemid IS 'gamesystemid of his Gamesystem ';


--
-- Name: game_gameid_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.game_gameid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.game_gameid_seq OWNER TO ensiie;

--
-- Name: game_gameid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.game_gameid_seq OWNED BY public.game.gameid;


--
-- Name: gamesystem; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.gamesystem (
    gamesystemid integer NOT NULL,
    systemname character varying(50) NOT NULL,
    systemdescription text
);


ALTER TABLE public.gamesystem OWNER TO ensiie;

--
-- Name: gamesystem_gamesystemid_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.gamesystem_gamesystemid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.gamesystem_gamesystemid_seq OWNER TO ensiie;

--
-- Name: gamesystem_gamesystemid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.gamesystem_gamesystemid_seq OWNED BY public.gamesystem.gamesystemid;


--
-- Name: gametag; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.gametag (
    tagid integer NOT NULL,
    tagname character varying(30) NOT NULL
);


ALTER TABLE public.gametag OWNER TO ensiie;

--
-- Name: gametag_tagid_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.gametag_tagid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.gametag_tagid_seq OWNER TO ensiie;

--
-- Name: gametag_tagid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.gametag_tagid_seq OWNED BY public.gametag.tagid;


--
-- Name: mastery; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.mastery (
    gamesystemid integer NOT NULL,
    userid integer NOT NULL
);


ALTER TABLE public.mastery OWNER TO ensiie;

--
-- Name: participation; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.participation (
    userid integer NOT NULL,
    gameid integer NOT NULL
);


ALTER TABLE public.participation OWNER TO ensiie;

--
-- Name: schedule; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.schedule (
    scheduleid integer NOT NULL,
    day public.dayofweek NOT NULL,
    hour public.hour,
    date date,
    recurrent boolean NOT NULL,
    reccurence character varying(50),
    gameid integer NOT NULL
);


ALTER TABLE public.schedule OWNER TO ensiie;

--
-- Name: schedule_scheduleid_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.schedule_scheduleid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.schedule_scheduleid_seq OWNER TO ensiie;

--
-- Name: schedule_scheduleid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.schedule_scheduleid_seq OWNED BY public.schedule.scheduleid;


--
-- Name: tagging; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.tagging (
    tagid integer NOT NULL,
    gameid integer NOT NULL
);


ALTER TABLE public.tagging OWNER TO ensiie;

--
-- Name: users; Type: TABLE; Schema: public; Owner: ensiie
--

CREATE TABLE public.users (
    userid integer NOT NULL,
    nick character varying(50) NOT NULL,
    firstname character varying(50),
    lastname character varying(50),
    mail character varying(50) NOT NULL,
    password character varying(200) NOT NULL
);


ALTER TABLE public.users OWNER TO ensiie;

--
-- Name: user_userid_seq; Type: SEQUENCE; Schema: public; Owner: ensiie
--

CREATE SEQUENCE public.user_userid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_userid_seq OWNER TO ensiie;

--
-- Name: user_userid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: ensiie
--

ALTER SEQUENCE public.user_userid_seq OWNED BY public.users.userid;


--
-- Name: comment commentid; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.comment ALTER COLUMN commentid SET DEFAULT nextval('public.comment_commentid_seq'::regclass);


--
-- Name: file fileid; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.file ALTER COLUMN fileid SET DEFAULT nextval('public.file_fileid_seq'::regclass);


--
-- Name: game gameid; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.game ALTER COLUMN gameid SET DEFAULT nextval('public.game_gameid_seq'::regclass);


--
-- Name: gamesystem gamesystemid; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.gamesystem ALTER COLUMN gamesystemid SET DEFAULT nextval('public.gamesystem_gamesystemid_seq'::regclass);


--
-- Name: gametag tagid; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.gametag ALTER COLUMN tagid SET DEFAULT nextval('public.gametag_tagid_seq'::regclass);


--
-- Name: schedule scheduleid; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.schedule ALTER COLUMN scheduleid SET DEFAULT nextval('public.schedule_scheduleid_seq'::regclass);


--
-- Name: users userid; Type: DEFAULT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.users ALTER COLUMN userid SET DEFAULT nextval('public.user_userid_seq'::regclass);


--
-- Data for Name: attachedfile; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.attachedfile (fileid, gameid) FROM stdin;
\.


--
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.comment (commentid, commentdate, content, gameid, userid) FROM stdin;
\.


--
-- Data for Name: file; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.file (fileid, filename, filehash, private, extension) FROM stdin;
\.


--
-- Data for Name: game; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.game (gameid, gamename, gamedesc, duration, private, gamesystemid, creator, illustration) FROM stdin;
\.


--
-- Data for Name: gamesystem; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.gamesystem (gamesystemid, systemname, systemdescription) FROM stdin;
\.


--
-- Data for Name: gametag; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.gametag (tagid, tagname) FROM stdin;
\.


--
-- Data for Name: mastery; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.mastery (gamesystemid, userid) FROM stdin;
\.


--
-- Data for Name: participation; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.participation (userid, gameid) FROM stdin;
\.


--
-- Data for Name: schedule; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.schedule (scheduleid, day, hour, date, recurrent, reccurence, gameid) FROM stdin;
\.


--
-- Data for Name: tagging; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.tagging (tagid, gameid) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: ensiie
--

COPY public.users (userid, nick, firstname, lastname, mail, password) FROM stdin;
11	Spawnie	\N	\N	josephine.barthel11@gmail.com	$2y$10$U6KNASw2zDtZXeXBxKnRzu9QCpN5PsLWJJGgfekW/bV4FSeJD6gcm
12	choucroute	\N	\N	choucroute@gmail.com	$2y$10$swB7V1CBAa82oDLaqm2wzuOP97fMCSzJO6mvicorickK1OvT5NC9.
\.


--
-- Name: comment_commentid_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.comment_commentid_seq', 1, false);


--
-- Name: file_fileid_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.file_fileid_seq', 1, false);


--
-- Name: game_gameid_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.game_gameid_seq', 1, false);


--
-- Name: gamesystem_gamesystemid_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.gamesystem_gamesystemid_seq', 1, false);


--
-- Name: gametag_tagid_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.gametag_tagid_seq', 1, false);


--
-- Name: schedule_scheduleid_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.schedule_scheduleid_seq', 1, false);


--
-- Name: user_userid_seq; Type: SEQUENCE SET; Schema: public; Owner: ensiie
--

SELECT pg_catalog.setval('public.user_userid_seq', 12, true);


--
-- Name: attachedfile attachedfile_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.attachedfile
    ADD CONSTRAINT attachedfile_pkey PRIMARY KEY (fileid, gameid);


--
-- Name: comment comment_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.comment
    ADD CONSTRAINT comment_pkey PRIMARY KEY (commentid);


--
-- Name: file file_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.file
    ADD CONSTRAINT file_pkey PRIMARY KEY (fileid);


--
-- Name: game game_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.game
    ADD CONSTRAINT game_pkey PRIMARY KEY (gameid);


--
-- Name: gamesystem gamesystem_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.gamesystem
    ADD CONSTRAINT gamesystem_pkey PRIMARY KEY (gamesystemid);


--
-- Name: gametag gametag_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.gametag
    ADD CONSTRAINT gametag_pkey PRIMARY KEY (tagid);


--
-- Name: mastery mastery_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.mastery
    ADD CONSTRAINT mastery_pkey PRIMARY KEY (gamesystemid, userid);


--
-- Name: participation participation_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.participation
    ADD CONSTRAINT participation_pkey PRIMARY KEY (userid, gameid);


--
-- Name: users primary_key_user; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT primary_key_user PRIMARY KEY (userid);


--
-- Name: schedule schedule_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.schedule
    ADD CONSTRAINT schedule_pkey PRIMARY KEY (scheduleid);


--
-- Name: tagging tagging_pkey; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.tagging
    ADD CONSTRAINT tagging_pkey PRIMARY KEY (tagid, gameid);


--
-- Name: users users_mail_key; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_mail_key UNIQUE (mail);


--
-- Name: users users_nick_key; Type: CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_nick_key UNIQUE (nick);


--
-- Name: comment_userid_index; Type: INDEX; Schema: public; Owner: ensiie
--

CREATE INDEX comment_userid_index ON public.comment USING btree (userid);


--
-- Name: game_creator_index; Type: INDEX; Schema: public; Owner: ensiie
--

CREATE INDEX game_creator_index ON public.game USING btree (creator);


--
-- Name: gameid_index; Type: INDEX; Schema: public; Owner: ensiie
--

CREATE INDEX gameid_index ON public.comment USING btree (gameid);


--
-- Name: gamesystemid_index; Type: INDEX; Schema: public; Owner: ensiie
--

CREATE INDEX gamesystemid_index ON public.game USING btree (gamesystemid);


--
-- Name: schedule_gameid_index; Type: INDEX; Schema: public; Owner: ensiie
--

CREATE INDEX schedule_gameid_index ON public.schedule USING btree (gameid);


--
-- Name: attachedfile attachedfile_fileid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.attachedfile
    ADD CONSTRAINT attachedfile_fileid_fkey FOREIGN KEY (fileid) REFERENCES public.file(fileid);


--
-- Name: attachedfile attachedfile_gameid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.attachedfile
    ADD CONSTRAINT attachedfile_gameid_fkey FOREIGN KEY (gameid) REFERENCES public.game(gameid);


--
-- Name: comment comment_gameid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.comment
    ADD CONSTRAINT comment_gameid_fkey FOREIGN KEY (gameid) REFERENCES public.game(gameid);


--
-- Name: comment comment_userid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.comment
    ADD CONSTRAINT comment_userid_fkey FOREIGN KEY (userid) REFERENCES public.users(userid);


--
-- Name: game game_creator_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.game
    ADD CONSTRAINT game_creator_fkey FOREIGN KEY (creator) REFERENCES public.users(userid);


--
-- Name: game game_gamesystemid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.game
    ADD CONSTRAINT game_gamesystemid_fkey FOREIGN KEY (gamesystemid) REFERENCES public.gamesystem(gamesystemid);


--
-- Name: game game_illustration_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.game
    ADD CONSTRAINT game_illustration_fkey FOREIGN KEY (illustration) REFERENCES public.file(fileid);


--
-- Name: mastery mastery_gamesystemid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.mastery
    ADD CONSTRAINT mastery_gamesystemid_fkey FOREIGN KEY (gamesystemid) REFERENCES public.gamesystem(gamesystemid);


--
-- Name: mastery mastery_userid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.mastery
    ADD CONSTRAINT mastery_userid_fkey FOREIGN KEY (userid) REFERENCES public.users(userid);


--
-- Name: participation participation_gameid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.participation
    ADD CONSTRAINT participation_gameid_fkey FOREIGN KEY (gameid) REFERENCES public.game(gameid);


--
-- Name: participation participation_userid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.participation
    ADD CONSTRAINT participation_userid_fkey FOREIGN KEY (userid) REFERENCES public.users(userid);


--
-- Name: schedule schedule_gameid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.schedule
    ADD CONSTRAINT schedule_gameid_fkey FOREIGN KEY (gameid) REFERENCES public.game(gameid);


--
-- Name: tagging tagging_gameid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.tagging
    ADD CONSTRAINT tagging_gameid_fkey FOREIGN KEY (gameid) REFERENCES public.game(gameid);


--
-- Name: tagging tagging_tagid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: ensiie
--

ALTER TABLE ONLY public.tagging
    ADD CONSTRAINT tagging_tagid_fkey FOREIGN KEY (tagid) REFERENCES public.gametag(tagid);


--
-- PostgreSQL database dump complete
--

\connect postgres

SET default_transaction_read_only = off;

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
-- Name: DATABASE postgres; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE postgres IS 'default administrative connection database';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- PostgreSQL database dump complete
--

\connect template1

SET default_transaction_read_only = off;

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
-- Name: DATABASE template1; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE template1 IS 'default template for new databases';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- PostgreSQL database dump complete
--

--
-- PostgreSQL database cluster dump complete
--

