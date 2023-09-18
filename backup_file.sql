--
-- PostgreSQL database dump
--

-- Dumped from database version 15.3 (Ubuntu 15.3-0ubuntu0.23.04.1)
-- Dumped by pg_dump version 15.3 (Ubuntu 15.3-0ubuntu0.23.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: agent; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.agent (
    id integer NOT NULL,
    mail character varying(255) NOT NULL,
    nom character varying(255) NOT NULL,
    prenom character varying(255) NOT NULL,
    mdp character varying(255) NOT NULL,
    roles character varying(255) NOT NULL
);


ALTER TABLE public.agent OWNER TO postgres;

--
-- Name: agent_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.agent_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.agent_id_seq OWNER TO postgres;

--
-- Name: agent_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.agent_id_seq OWNED BY public.agent.id;


--
-- Name: avis; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.avis (
    id integer NOT NULL,
    client_id integer,
    note integer,
    titre character varying(255),
    texte text
);


ALTER TABLE public.avis OWNER TO postgres;

--
-- Name: avis_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.avis_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.avis_id_seq OWNER TO postgres;

--
-- Name: avis_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.avis_id_seq OWNED BY public.avis.id;


--
-- Name: client; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.client (
    id integer NOT NULL,
    mail character varying(255) NOT NULL,
    nom character varying(255) NOT NULL,
    prenom character varying(255) NOT NULL,
    mdp character varying(255) NOT NULL,
    images character varying(255),
    role character varying(255) DEFAULT 'client'::character varying NOT NULL
);


ALTER TABLE public.client OWNER TO postgres;

--
-- Name: client_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.client_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.client_id_seq OWNER TO postgres;

--
-- Name: client_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.client_id_seq OWNED BY public.client.id;


--
-- Name: location; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.location (
    id integer NOT NULL,
    client_id integer,
    date_location date NOT NULL,
    horaire time without time zone NOT NULL,
    score integer,
    terrain_id integer
);


ALTER TABLE public.location OWNER TO postgres;

--
-- Name: location_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.location_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.location_id_seq OWNER TO postgres;

--
-- Name: location_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.location_id_seq OWNED BY public.location.id;


--
-- Name: locations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.locations (
    location_id integer NOT NULL,
    joueur_id integer,
    date_location date,
    terrain_id integer
);


ALTER TABLE public.locations OWNER TO postgres;

--
-- Name: locations_location_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.locations_location_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.locations_location_id_seq OWNER TO postgres;

--
-- Name: locations_location_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.locations_location_id_seq OWNED BY public.locations.location_id;


--
-- Name: stat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.stat (
    id integer NOT NULL,
    matchjouer integer,
    matchgagner integer,
    but integer,
    passedecisive integer
);


ALTER TABLE public.stat OWNER TO postgres;

--
-- Name: stat_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.stat_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.stat_id_seq OWNER TO postgres;

--
-- Name: stat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.stat_id_seq OWNED BY public.stat.id;


--
-- Name: terrain; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.terrain (
    nom character varying(255) NOT NULL,
    capacite integer,
    typeterrain character varying(255),
    etat character varying(255),
    images character varying(255),
    adresse character varying(255),
    location character varying(10) DEFAULT 'libre'::character varying,
    id integer NOT NULL
);


ALTER TABLE public.terrain OWNER TO postgres;

--
-- Name: terrain_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.terrain_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.terrain_id_seq OWNER TO postgres;

--
-- Name: terrain_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.terrain_id_seq OWNED BY public.terrain.id;


--
-- Name: tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tokens (
    id integer NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT now(),
    expiration_at timestamp without time zone
);


ALTER TABLE public.tokens OWNER TO postgres;

--
-- Name: tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tokens_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tokens_id_seq OWNER TO postgres;

--
-- Name: tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tokens_id_seq OWNED BY public.tokens.id;


--
-- Name: agent id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agent ALTER COLUMN id SET DEFAULT nextval('public.agent_id_seq'::regclass);


--
-- Name: avis id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.avis ALTER COLUMN id SET DEFAULT nextval('public.avis_id_seq'::regclass);


--
-- Name: client id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client ALTER COLUMN id SET DEFAULT nextval('public.client_id_seq'::regclass);


--
-- Name: location id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.location ALTER COLUMN id SET DEFAULT nextval('public.location_id_seq'::regclass);


--
-- Name: locations location_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.locations ALTER COLUMN location_id SET DEFAULT nextval('public.locations_location_id_seq'::regclass);


--
-- Name: stat id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.stat ALTER COLUMN id SET DEFAULT nextval('public.stat_id_seq'::regclass);


--
-- Name: terrain id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.terrain ALTER COLUMN id SET DEFAULT nextval('public.terrain_id_seq'::regclass);


--
-- Name: tokens id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tokens ALTER COLUMN id SET DEFAULT nextval('public.tokens_id_seq'::regclass);


--
-- Data for Name: agent; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.agent (id, mail, nom, prenom, mdp, roles) FROM stdin;
\.


--
-- Data for Name: avis; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.avis (id, client_id, note, titre, texte) FROM stdin;
\.


--
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.client (id, mail, nom, prenom, mdp, images, role) FROM stdin;
7	admin@domain.com	Admin	Admin	$2y$10$yvIbreF6mMXbitYZOzmNIONXh6lK3V/M7hbstejvX.gvlgn7My2zK	admin_image.png	admin
9	ibrahim60200@gmail.com	Ouahabi	Ibrahim	$2y$10$yvIbreF6mMXbitYZOzmNIONXh6lK3V/M7hbstejvX.gvlgn7My2zK	\N	admin
10	ibrahim.ouahabi@outlook.fr	Ouahabi	Ibrahim	$2y$10$yvIbreF6mMXbitYZOzmNIONXh6lK3V/M7hbstejvX.gvlgn7My2zK	\N	client
11	iouahabi1@myges.fr	Ouahabi	Ibrahim	$2y$10$yvIbreF6mMXbitYZOzmNIONXh6lK3V/M7hbstejvX.gvlgn7My2zK	\N	admin
12	linascolas60@hotmail.com	Colas	Lina	$2y$10$yvIbreF6mMXbitYZOzmNIONXh6lK3V/M7hbstejvX.gvlgn7My2zK	\N	client
13	ayou.ouahabi@outlook.fr	Ouahabi	Ayoub	$2y$10$pu2mqrEB8yoFBOR16Pf70ufdddppkVdga57BMhUW1WbYvG13.Wuia	\N	admin
14	ayou.ouahabi@outlook.fr	Ouahabi	Ayoub	$2y$10$wVyVN3rGhyUGpFlwmN25LOGfUM8xiZp7KZl7UyDoPcS.yV7dE2bgu	\N	admin
15	y.skrzypczyk@gmail.com	Skrzypczyk	<script>alert("test")</script>	$2y$10$3rS36j.yFnKSAK62FHW5/.vUvUVq9qydjHSCFvtK7eyT3qKDBVzZm	\N	client
16	tdomingues@myges.fr	Domingues	Thomas	$2y$10$KL/uaLxlnGX4IebJJZmKxuhvSr09jeCC45hqisr8JP0KvbZOc3H.6	\N	client
18	karl+3IW2G1@kmarques.dev	karl	karl	$2y$10$XVVApegFd4pKGhLGgSBwIOlgiWxXmKbCzVYGHg2mmq3/lKrGXJBxO	\N	client
19	y.skrzypczyk@gmail.com	<script>alert("test")</script>	<script>alert("test")</script>	$2y$10$e0b4Yvmz1HLN7XomhKW15exGrICurVwl28vWjF7wBylWYvzM2hc2i	\N	client
20	karl+gr14@kmarques.dev	test	test	$2y$10$4t9VdvvwysL4EAVfhfv8FurryFA6a9DJxUzTDOhPaMX9roktqflWG	\N	client
21	y.skrzypczyk@gmail.fr	<script>alert("test")</script>	<script>alert("test")</script>	$2y$10$VtgmdeM.JXTwtZ93DYqZxuezfb2pVPMHVjjmzVXuhldMTlJyDre/K	\N	client
22	tadji.aboudou@gmail.com	aboudou	tadjidin	$2y$10$DLbdg8iGwNY1rIgk.rROau0VDfvm.PlCkFEDsAdNmiy1BST3QFDH2	\N	admin
23	rsmile310@gmail.com	Anastasia	Anastasia	$2y$10$tWH2j4qzq4vRipuggZ7UEOf0xRWLXhmBADrQImMkBnKwIuc.LXvSy	\N	client
24	ding.w98106	Fjkfjrj123	Fjkfjrj123	$2y$10$sf6WWB0lWMXTiRh2K2NosOrDJwhMmQuzaKkNzj0O2MyGKJICsfJGK	\N	client
25	tbc@tbc.com	Shahnawaz	Devloper	$2y$10$cHF5yXwmfg4ke4Zb.ss4k.jku0ViQzAMe3FuvKgeY/p05LfZ2mF0q	\N	client
26	ouahabi.ibrahim@outlook.fr	Ouahabi	Ibrahim	$2y$10$kcoDrSpHRelubobDRGYOw.QQBhdFJeBcUO23QZClnB8LD15fmx3vq	\N	client
27	kiransrm15@gmail.com	TEST	TEST	$2y$10$rAAOreXvudHRq0RAT4xzpuIqpZsfnQ58ps1nWPZe1Cxf5Dby8U0xa	\N	admin
\.


--
-- Data for Name: location; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.location (id, client_id, date_location, horaire, score, terrain_id) FROM stdin;
\.


--
-- Data for Name: locations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.locations (location_id, joueur_id, date_location, terrain_id) FROM stdin;
1	1	2023-06-01	\N
2	2	2023-06-05	\N
3	1	2023-06-08	\N
4	3	2023-06-10	\N
5	2	2023-06-12	\N
6	\N	2023-07-20	\N
7	\N	2023-07-21	\N
8	\N	2023-07-21	\N
\.


--
-- Data for Name: stat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.stat (id, matchjouer, matchgagner, but, passedecisive) FROM stdin;
1	10	5	20	7
2	15	7	25	10
3	12	6	18	8
4	18	9	27	13
5	20	10	30	15
6	17	8	25	12
7	16	7	23	11
8	19	9	29	14
9	13	6	19	9
10	14	7	21	10
\.


--
-- Data for Name: terrain; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.terrain (nom, capacite, typeterrain, etat, images, adresse, location, id) FROM stdin;
Terrain A	10	Pelouse	Disponible	terrainA.jpg	Adresse A	occupé	1
Terrain B	8	Synthétique	Disponible	terrainB.jpg	Adresse B	occupé	2
Ouahabi	8	Synthe	Correcte	uploads/2021-02-28 (1).png	242 rue faubourg Saint-Antoine, 75012 Paris	occupé	6
Terrain C	12	Pelouse	Occupé	terrainC.jpg	Adresse C	occupé	3
Terrain D	6	Pelouse	Disponible	terrainD.jpg	Adresse D	occupé	4
Terrain E	10	Synthétique	Disponible	terrainE.jpg	Adresse E	occupé	5
Compiegne	22	Gazon naturel	Correct	uploads/terrain-futsal-453.jpg	222 rue faubourg Saint-Antoine, 75012 Paris	occupé	10
Carcassonne	10	En salle	Correct	uploads/	Carcassonne	occupé	11
TEST	5	En salle	Correct	uploads/	60200	occupé	8
Five	10	En salle	Correct	uploads/terrain-futsal-453.jpg	75012	occupé	9
ESG	22	Herrbe	Parfait	uploads/	222 rue faubourg Saint-Antoine, 75012 Paris	occupé	7
Nation	100	Gazon hybride	Neuf	uploads/téléchargement.jpeg	242 rue faubourg Saint-Antoine, 75012 Paris	occupé	13
Challenge	10	En salle	Correct	uploads/	Challenge	libre	14
Tadj	22	Gazon synthétique	Correcte	uploads/	242 rue faubourg Saint-Antoine, 75012 Paris	occupé	12
\.


--
-- Data for Name: tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tokens (id, token, created_at, expiration_at) FROM stdin;
1	939971ade582c4453568d6a482eec5c615e73d4991eda2be755bcbca16a4d0ef3bfb7ec7239d5969a935ff087f59359b2c82	2023-07-18 08:26:57.665363	2023-07-18 08:36:57.665363
3	73745d432e95c1e7733de2a32b9be9ec2503119260ea00374d2f73eabb6c312adc5218b193288194fcfb3ac3d4eebccb2628	2023-07-20 21:54:21.862888	2023-07-20 22:04:21.862888
4	081c5870208f07807dab04a368dfe1338f648c1a344c3feb8de157580d8d730689ad61edce19f0e3c7fb0ed76af5722af12f	2023-07-20 22:10:51.919648	2023-07-20 22:20:51.919648
5	ca9f2b1260fea01a0d2fe8de8578a340ca591ff29f0b2c6018142e269ad2f1db9ec92b44f56af05a7ffe430089a4314c2288	2023-07-20 22:10:57.114334	2023-07-20 22:20:57.114334
6	54750ed8b5e6173bb09df43ffacccff38becdfc8f47273342d0f7771caff0f7de249327665a42064496f908fec0f2445bae1	2023-07-20 22:12:57.319259	2023-07-20 22:22:57.319259
8	144bbe16d94f60927d750e611b1b86b6eff669ee9c3773ea424730a215b53479e9400fa5f3241d99c5fd5dd5ad5453a82f6e	2023-08-16 08:00:57.606855	2023-08-16 08:10:57.606855
9	64a833d7cf87eb226919212c512c7a1d8fc4eca94ab5e4eb2bdc2336604e51ca09988f25b0dbe99dfb4a4d1b55f418b50bc8	2023-08-16 08:00:59.228209	2023-08-16 08:10:59.228209
10	7e8c10ec6a1f544357f35bed91423b36062a6623d0dbc7977baac617cf30b154bc0b1d5d81261ffd6f54c986ddab202f9fbf	2023-08-16 08:06:14.004692	2023-08-16 08:16:14.004692
11	86220d0a309bfb36c8fb9c2a09ec5c516e10c4129595c66fdc677a016c654b07cc57421c56d44bf1273997623d0d21bd442a	2023-08-16 08:13:51.034405	2023-08-16 08:23:51.034405
12	9eacaacf703556df825610ec0b54d70e3b113e5c5ce0efa3366f4643db88bceac4294cd383439d99064771b744f980a6b515	2023-08-16 09:36:11.354578	2023-08-16 09:46:11.354578
\.


--
-- Name: agent_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.agent_id_seq', 1, false);


--
-- Name: avis_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.avis_id_seq', 1, false);


--
-- Name: client_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.client_id_seq', 27, true);


--
-- Name: location_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.location_id_seq', 1, false);


--
-- Name: locations_location_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.locations_location_id_seq', 8, true);


--
-- Name: stat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.stat_id_seq', 10, true);


--
-- Name: terrain_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.terrain_id_seq', 14, true);


--
-- Name: tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tokens_id_seq', 12, true);


--
-- Name: agent agent_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agent
    ADD CONSTRAINT agent_pkey PRIMARY KEY (id);


--
-- Name: avis avis_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.avis
    ADD CONSTRAINT avis_pkey PRIMARY KEY (id);


--
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id);


--
-- Name: location location_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.location
    ADD CONSTRAINT location_pkey PRIMARY KEY (id);


--
-- Name: locations locations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.locations
    ADD CONSTRAINT locations_pkey PRIMARY KEY (location_id);


--
-- Name: stat stat_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.stat
    ADD CONSTRAINT stat_pkey PRIMARY KEY (id);


--
-- Name: terrain terrain_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.terrain
    ADD CONSTRAINT terrain_pkey PRIMARY KEY (id);


--
-- Name: tokens tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tokens
    ADD CONSTRAINT tokens_pkey PRIMARY KEY (id);


--
-- Name: avis avis_client_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.avis
    ADD CONSTRAINT avis_client_id_fkey FOREIGN KEY (client_id) REFERENCES public.client(id);


--
-- Name: locations fk_locations_terrain; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.locations
    ADD CONSTRAINT fk_locations_terrain FOREIGN KEY (terrain_id) REFERENCES public.terrain(id);


--
-- Name: location location_client_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.location
    ADD CONSTRAINT location_client_id_fkey FOREIGN KEY (client_id) REFERENCES public.client(id);


--
-- PostgreSQL database dump complete
--

