--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.10
-- Dumped by pg_dump version 9.6.10

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: pgcrypto; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS pgcrypto WITH SCHEMA public;


--
-- Name: EXTENSION pgcrypto; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION pgcrypto IS 'cryptographic functions';


--
-- Name: uuid-ossp; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS "uuid-ossp" WITH SCHEMA public;


--
-- Name: EXTENSION "uuid-ossp"; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION "uuid-ossp" IS 'generate universally unique identifiers (UUIDs)';


--
-- Name: btrsort(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.btrsort(text) RETURNS text
    LANGUAGE sql
    AS $_$


	SELECT 


		CASE WHEN char_length($1)>0 THEN


			CASE WHEN $1 ~ '^[^0-9]+' THEN


				RPAD(SUBSTR(COALESCE(SUBSTRING($1 FROM '^[^0-9]+'), ''), 1, 12), 12, ' ') || btrsort(btrsort_nextunit($1))


			ELSE


				LPAD(SUBSTR(COALESCE(SUBSTRING($1 FROM '^[0-9]+'), ''), 1, 12), 12, ' ') || btrsort(btrsort_nextunit($1))


			END


		ELSE


			$1


		END


      ;


$_$;


ALTER FUNCTION public.btrsort(text) OWNER TO postgres;

--
-- Name: btrsort_nextunit(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.btrsort_nextunit(text) RETURNS text
    LANGUAGE sql
    AS $_$


	SELECT 


		CASE WHEN $1 ~ '^[^0-9]+' THEN


			COALESCE( SUBSTR( $1, LENGTH(SUBSTRING($1 FROM '[^0-9]+'))+1 ), '' )


		ELSE


			COALESCE( SUBSTR( $1, LENGTH(SUBSTRING($1 FROM '[0-9]+'))+1 ), '' )


		END


$_$;


ALTER FUNCTION public.btrsort_nextunit(text) OWNER TO postgres;

--
-- Name: natsortint(character varying); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.natsortint(valor character varying) RETURNS integer[]
    LANGUAGE plpgsql
    AS $$


BEGIN


RETURN textArray2intergerArray(REGEXP_SPLIT_TO_ARRAY(valor, '[^0-9]+'));


END;


$$;


ALTER FUNCTION public.natsortint(valor character varying) OWNER TO postgres;

--
-- Name: textarray2intergerarray(character varying[]); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.textarray2intergerarray(valor character varying[]) RETURNS integer[]
    LANGUAGE plpgsql
    AS $$


DECLARE


i integer := 1;


ret integer[];


BEGIN


FOR i IN COALESCE(ARRAY_LOWER(valor, 1) ,0) .. COALESCE(ARRAY_UPPER(valor, 1), -1) LOOP


IF LENGTH(valor[i]) > 0 THEN


ret := ret || valor[i]::integer;


ELSE


ret := ret || 0;


END IF;


END LOOP;


RETURN ret;


END;


$$;


ALTER FUNCTION public.textarray2intergerarray(valor character varying[]) OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: contract; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contract (
    id uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    contract_code character varying(20),
    start_date date,
    end_date date,
    contract_type integer,
    grand_total_price real,
    sales_id uuid,
    customer_id uuid,
    payment_term_type integer,
    contract_status integer,
    quotation_id uuid,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone NOT NULL
);


ALTER TABLE public.contract OWNER TO postgres;

--
-- Name: customer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.customer (
    id uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    firstname text,
    lastname text,
    phone text,
    email text,
    address text,
    province character varying(2),
    postcode text,
    company_name text,
    channel integer,
    type integer,
    active_status boolean DEFAULT true NOT NULL,
    company_id uuid,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone NOT NULL
);


ALTER TABLE public.customer OWNER TO postgres;

--
-- Name: leads; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.leads (
    id uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    firstname text,
    lastname text,
    phone text,
    email text,
    address text,
    province character varying(2),
    postcode character varying(10),
    channel integer DEFAULT 0 NOT NULL,
    type integer DEFAULT 0 NOT NULL,
    sales_status integer DEFAULT 0 NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone NOT NULL
);


ALTER TABLE public.leads OWNER TO postgres;

--
-- Name: product; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.product (
    id uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    product_code character varying(20) NOT NULL,
    name text NOT NULL,
    description text NOT NULL,
    price real DEFAULT '0'::real NOT NULL,
    price_with_vat real DEFAULT '0'::real NOT NULL,
    vat real DEFAULT '0'::real NOT NULL,
    is_delete boolean DEFAULT false NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone NOT NULL
);


ALTER TABLE public.product OWNER TO postgres;

--
-- Name: property; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.property (
    id uuid NOT NULL,
    juristic_person_name_th character varying(200),
    province integer,
    juristic_person_name_en character varying(200),
    property_name_th character varying(200),
    property_name_en character varying(200),
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    developer_group_id uuid,
    customer_id uuid
);


ALTER TABLE public.property OWNER TO postgres;

--
-- Name: quotation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.quotation (
    id uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    quotation_code character varying(20),
    invalid_date date,
    total_price real DEFAULT '0'::real NOT NULL,
    total_discount real DEFAULT '0'::real NOT NULL,
    grand_total_price real DEFAULT '0'::real NOT NULL,
    remark text,
    sales_id uuid,
    lead_id uuid,
    send_email_status boolean DEFAULT false NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone NOT NULL
);


ALTER TABLE public.quotation OWNER TO postgres;

--
-- Name: quotation_transaction; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.quotation_transaction (
    id uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    product_id uuid NOT NULL,
    quotation_id uuid NOT NULL,
    product_amount integer DEFAULT 0 NOT NULL,
    product_price real DEFAULT '0'::real NOT NULL,
    product_price_with_vat real DEFAULT '0'::real NOT NULL,
    product_vat real DEFAULT '0'::real NOT NULL,
    grand_total_price real DEFAULT '0'::real NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone NOT NULL
);


ALTER TABLE public.quotation_transaction OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO postgres;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    name text,
    password character varying(200),
    email character varying(100),
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    remember_token text,
    role integer,
    profile_pic_name character varying(50),
    profile_pic_path character varying(10),
    dob date,
    phone character varying(100),
    active boolean DEFAULT true,
    lang character varying(3) DEFAULT 'th'::character varying,
    gender character varying(1),
    deleted boolean DEFAULT false NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: COLUMN users.role; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.users.role IS '0 = AdminNabour, 1 = Adminα╕½α╕íα╕╣α╣êα╕Üα╣ëα╕▓α╕Ö, 2 = α╕Ñα╕╣α╕üα╕Üα╣ëα╕▓α╕Ö, 3 = α╕₧α╕Öα╕▒α╕üα╕çα╕▓α╕Ö, 4 = Sale, 5 = OfficerAdmin';


--
-- Name: COLUMN users.deleted; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.users.deleted IS 'flag delete';


--
-- Data for Name: contract; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.contract (id, contract_code, start_date, end_date, contract_type, grand_total_price, sales_id, customer_id, payment_term_type, contract_status, quotation_id, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: customer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.customer (id, firstname, lastname, phone, email, address, province, postcode, company_name, channel, type, active_status, company_id, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: leads; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.leads (id, firstname, lastname, phone, email, address, province, postcode, channel, type, sales_status, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: product; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.product (id, product_code, name, description, price, price_with_vat, vat, is_delete, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: property; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.property (id, juristic_person_name_th, province, juristic_person_name_en, property_name_th, property_name_en, created_at, updated_at, developer_group_id, customer_id) FROM stdin;
cd60a445-3bbf-48fd-9762-a0689261cc16	โนเบิล วานา วัชรพล	10	NOBLE WANA WATCHARAPOL	โนเบิล วานา วัชรพล	NOBLE DEVELOPMENT	2016-05-09 20:43:02	2016-05-09 20:43:02	\N	\N
2fe4163c-8f94-4737-b098-fba6d4f00db2	วันพลัส เจ็ดยอด 2	50	วันพลัส เจ็ดยอด 2	วันพลัส เจ็ดยอด 2	วันพลัส เจ็ดยอด 2	2016-11-01 13:46:05	2016-11-01 13:46:05	\N	\N
c90bd159-5c8a-41b4-b6c8-164ddbda41b2	หมู่บ้าน NB006	50	Demo NB006	หมู่บ้าน NB006	Demo NB006	2015-01-01 00:00:00	2017-02-09 10:12:11	\N	\N
ec4e4848-7fba-4a90-97d2-2afacbf9f86e	หมู่บ้าน NB004	50	Demo NB004	หมู่บ้าน NB004	Demo NB004	2015-01-01 00:00:00	2017-02-07 14:29:27	\N	\N
0ccb830f-fb74-4bad-a855-3740c74be8cc	คอนโดทดลองใช้งาน	50	Condo Demo	คอนโดทดลองใช้งาน	Condo Demo	2015-01-01 00:00:00	\N	\N	\N
dfc566af-342f-4c96-b9fc-28fd83b902aa	พีคส์ อเวนิว คอนโดมิเนียม	50	Peaks Avenue	พีคส์ อเวนิว คอนโดมิเนียม	Peaks Avenue	2016-04-20 12:36:05	2016-04-20 12:36:05	\N	\N
7bebfc23-4e1b-46fd-874b-3bc167bc1a24	นิติบุคคลกาญจน์กนกวิลล์3	50	Kankanok Ville3 Julistic Person	กาญจน์กนกวิลล์3	Kankanok Ville3	2016-05-07 14:51:23	2016-05-07 14:51:23	\N	\N
9f9fed90-85bf-42df-a18d-153cc056bcde	วันพลัส ห้วยแก้ว	50	OnePlus Huaykaew	วันพลัส ห้วยแก้ว	OnePlus Huaykaew	2016-11-29 15:31:18	2016-11-29 15:31:18	\N	\N
c06ef23a-53ec-44c2-93e7-c78322693758	หมู่บ้าน NB011	50	Demo NB011	หมู่บ้าน NB011	Demo NB011	2017-02-09 09:49:32	2017-02-09 09:49:32	\N	\N
25f58826-45ea-49fc-87f7-033c08d94060	หมู่บ้าน NB013	50	Demo NB013	หมู่บ้าน NB013	Demo NB013	2017-02-09 09:49:34	2017-02-09 09:49:34	\N	\N
a01a8b60-739f-4024-b608-e2e993a2d13b	หมู่บ้าน NB016	50	Demo NB016	หมู่บ้าน NB016	Demo NB016	2017-02-09 09:49:36	2017-03-24 17:50:05	\N	\N
3e224c56-fc1a-4bf7-ace0-193de28e0b78	หมู่บ้าน NB002	50	Demo NB002	หมู่บ้าน NB002	Demo NB002	2015-01-01 00:00:00	2018-06-18 19:41:21	\N	\N
eaaa8e66-6217-4bf0-aeb7-dbba5073ae36	หมู่บ้าน NB003	50	Demo NB003	หมู่บ้าน NB003	Demo NB003	2015-01-01 00:00:00	2018-06-03 13:03:16	\N	\N
453ae765-4042-428a-9a5a-6510092ac232	หมู่บ้าน NB008	50	Demo NB008	หมู่บ้าน NB008	Demo NB008	2017-02-09 09:49:30	2017-02-09 09:49:30	\N	\N
e05e6c04-ff2e-474d-ad34-9b2ef46ddc31	หมู่บ้าน NB009	50	Demo NB009	หมู่บ้าน NB009	Demo NB009	2017-02-09 09:49:31	2017-02-09 09:49:31	\N	\N
2ce6c772-7871-45a5-9dda-443d27654301	หมู่บ้าน NB010	50	Demo NB010	หมู่บ้าน NB010	Demo NB010	2017-02-09 09:49:32	2017-02-09 09:49:32	\N	\N
1eaa07a9-9955-40fa-94a9-587494b4e1f9	หมู่บ้าน NB015	50	Demo NB015	หมู่บ้าน NB015	Demo NB015	2017-02-09 09:49:35	2017-02-09 09:49:35	\N	\N
8f8835d1-9c2f-4d58-9677-ca7acc42404e	หมู่บ้าน NB007	50	Demo NB007	หมู่บ้าน NB007	Demo NB007	2017-02-09 09:49:30	2017-02-13 17:00:32	\N	\N
e0bce0da-e26f-416d-8315-916a83725ef9	หมู่บ้าน NB012	50	Demo NB012	หมู่บ้าน NB012	Demo NB012	2017-02-09 09:49:33	2017-03-08 15:53:10	\N	\N
b69c6110-7d8d-4bd5-a213-193fa4ee4218	เดอะ บริค	50	The Brick	เดอะ บริค	The Brick	2015-01-01 00:00:00	2017-03-04 17:44:11	\N	\N
0ed99fa2-257d-4863-addb-770d29db7a04	หมู่บ้าน NB019	50	Demo NB019	หมู่บ้าน NB019	Demo NB019	2017-02-14 13:53:58	2017-02-14 13:53:58	\N	\N
b8128c65-0f1a-4922-9094-9b7bb20dd922	หมู่บ้าน NB014	50	Demo NB014	หมู่บ้าน NB014	Demo NB014	2017-02-09 09:49:35	2017-05-19 11:32:04	\N	\N
25a1f8f3-a2d3-44d0-a9f7-29a4acce4141	หมู่บ้านชัยพฤกษ์ บางบัวทอง	12	Mubhan Chaiyapreak Bang Bau Thong	หมู่บ้านชัยพฤกษ์ บางบัวทอง	์Mubhan Chaiyapreak Bang Bau Thong	2015-01-01 00:00:00	2017-05-28 15:08:35	\N	\N
8bfe6d1f-196a-4619-8521-40fb0951b395	หมู่บ้าน NB020	50	Demo NB020	หมู่บ้าน NB020	Demo NB020	2017-02-14 13:53:59	2017-02-14 13:53:59	\N	\N
14a2434a-a03c-4676-89bf-a4132b0fee66	หมู่บ้าน NB021	50	Demo NB021	หมู่บ้าน NB021	Demo NB021	2017-02-14 13:54:00	2017-02-14 13:54:00	\N	\N
be7d37d8-a59a-42c8-a6e1-dc3e584a8d66	หมู่บ้าน NB022	50	Demo NB022	หมู่บ้าน NB022	Demo NB022	2017-02-14 13:54:01	2017-02-14 13:54:01	\N	\N
ee5576ca-3929-4a97-abf5-2a84c464196a	หมู่บ้าน NB023	50	Demo NB023	หมู่บ้าน NB023	Demo NB023	2017-02-14 13:54:01	2017-02-14 13:54:01	\N	\N
78c9130c-15c7-417a-b17f-1836f53f49fe	หมู่บ้าน NB018	50	Demo NB018	หมู่บ้าน NB018	Demo NB018	2017-02-14 13:53:57	2018-03-15 14:45:53	\N	\N
31be7fc5-42f7-4f50-8b9a-179a615283d8	หมู่บ้าน NB024	50	Demo NB024	หมู่บ้าน NB024	Demo NB024	2017-02-14 13:54:01	2017-02-14 13:54:01	\N	\N
477c8f94-e1a9-4ec4-bc62-cec25d5f58c7	หมู่บ้าน NB025	50	Demo NB025	หมู่บ้าน NB025	Demo NB025	2017-02-14 13:54:02	2017-02-14 13:54:02	\N	\N
7641c9f9-50ff-42b6-93a3-f521eec6a68a	หมู่บ้าน NB026	50	Demo NB026	หมู่บ้าน NB026	Demo NB026	2017-02-14 13:54:03	2017-02-14 13:54:03	\N	\N
ab57430f-e3b1-4ea5-8751-a54c2358c77b	The Greenery Villa	50	The Greenery Villa	เดอะ กรีนเนอรี่ วิลล่า	เดอะ กรีนเนอรี่ วิลล่า	2017-02-09 13:00:08	2017-02-23 18:36:18	\N	\N
6a43d2f7-db16-45a4-a4fe-c4745a004bf6	นิติบุคคลหมู่บ้านจัดสรร "วิลเลจปาร์ค"	20	นิติบุคคลหมู่บ้านจัดสรร "วิลเลจปาร์ค"	วิลเลจปาร์ค	วิลเลจปาร์ค	2017-01-31 14:45:00	2017-05-02 16:26:02	\N	\N
9955700b-5b1c-4dcb-a3c5-2803a48dd743	หมู่บ้าน NB031	50	Demo NB031	หมู่บ้าน NB031	Demo NB031	2017-04-04 14:07:15	2017-04-04 14:07:15	\N	\N
660d5e33-00cd-4d75-867f-33bd89a9e6e6	หมู่บ้าน NB032	50	Demo NB032	หมู่บ้าน NB032	Demo NB032	2017-04-04 14:07:16	2017-04-04 14:07:16	\N	\N
25479b6f-9882-446b-ae2f-93bbaee0f368	หมู่บ้าน NB034	50	Demo NB034	หมู่บ้าน NB034	Demo NB034	2017-04-04 14:07:17	2017-04-04 14:07:17	\N	\N
2ef0935c-f34e-497a-8294-9d0a57a9995f	หมู่บ้าน NB036	50	Demo NB036	หมู่บ้าน NB036	Demo NB036	2017-04-04 14:07:19	2017-04-04 14:07:19	\N	\N
fc10b510-2428-4aee-9b9b-dc6690a6e5b7	หมู่บ้าน NB027	50	Demo NB027	หมู่บ้าน NB027	Demo NB027	2017-04-04 14:07:13	2017-10-12 16:39:12	\N	\N
55ae78dd-2d8a-44a8-a754-d432fee597cd	หมู่บ้าน NB039	50	Demo NB039	หมู่บ้าน NB039	Demo NB039	2017-04-05 15:29:59	2017-04-05 15:29:59	\N	\N
9f486aa3-8f72-4da5-b725-0d7a506e02db	หมู่บ้าน NB040	50	Demo NB040	หมู่บ้าน NB040	Demo NB040	2017-04-05 15:29:59	2017-04-05 15:29:59	\N	\N
e203adf6-4e0d-4024-84c3-10ec331db237	โกลเด้นพัทยา	20	Demo	อาคารโกลเด้นพัทยาคอนโดมิเนียม	Demo 	2017-04-04 14:07:14	2017-06-16 10:03:59	\N	\N
5d951cbe-3f02-4394-80a8-f639c324e96a	หมู่บ้าน NB028	50	Demo NB028	หมู่บ้าน NB028	Demo NB028	2017-04-04 14:07:13	2017-05-05 15:39:26	\N	\N
27cc893b-0c7c-4455-a1fe-c02ef7b92730	หมู่บ้านศุภาลัย กาเด้นวิลล์ บางแสน	50	Supalai Garden View Bangsean Community	หมู่บ้านศุภาลัย กาเด้นวิลล์ บางแสน	Supalai Garden View Bangsean	2017-04-04 14:07:15	2017-07-18 23:34:34	\N	\N
35210b4e-73e8-4691-8c25-f424bc93a8b5	หมู่บ้าน NB033	50	Demo NB033	หมู่บ้าน NB033	Demo NB033	2017-04-04 14:07:17	2017-07-27 14:15:06	\N	\N
dd79f6e7-ffff-47aa-b756-9038b8bb9862	หมู่บ้าน NB041	50	Demo NB041	หมู่บ้าน NB041	Demo NB041	2017-04-05 15:30:00	2017-04-05 15:30:00	\N	\N
7ac0a312-d999-4dcc-9f44-90d94c5313bc	หมู่บ้าน NB042	50	Demo NB042	หมู่บ้าน NB042	Demo NB042	2017-04-05 15:30:01	2017-04-05 15:30:01	\N	\N
a1dbc182-0b75-461a-8cba-1ffbf90486d6	หมู่บ้าน NB043	50	Demo NB043	หมู่บ้าน NB043	Demo NB043	2017-04-05 15:30:02	2017-04-05 15:30:02	\N	\N
5796401c-85de-4f4a-9544-f6d03f37de46	หมู่บ้าน NB044	50	Demo NB044	หมู่บ้าน NB044	Demo NB044	2017-04-05 15:30:03	2017-05-17 10:47:52	\N	\N
3f0caaa9-11e2-4e2e-bdcc-85884a0dd789	เดอะล๊อก3คอนโด	10	The Log 3 Condo 	เดอะล๊อก3คอนโด	The Log 3 Condo 	2017-04-05 15:29:58	2017-04-11 16:41:16	\N	\N
4bd8ff3d-48d6-4948-b232-f8414f2056aa	หมู่บ้าน NB046	50	Demo NB046	หมู่บ้าน NB046	Demo NB046	2017-04-05 15:30:04	2017-05-18 10:11:00	\N	\N
7e43acc7-0342-4ae2-831e-3b309961499b	หมู่บ้าน NB061	50	Demo NB061	หมู่บ้าน NB061	Demo NB061	2017-05-26 14:12:30	2017-10-10 18:43:02	\N	\N
767cd25d-8c3b-45c9-8e62-b55ef9d7365e	หมู่บ้าน NB062	50	Demo NB062	หมู่บ้าน NB062	Demo NB062	2017-05-26 14:12:31	2017-05-26 14:12:31	\N	\N
4cdbcbb1-e223-4a0b-b898-af5ec431e6d2	หมู่บ้าน NB054	50	Demo NB054	หมู่บ้าน NB054	Demo NB054	2017-05-26 14:12:26	2017-05-26 14:12:26	\N	\N
1ce05081-a213-445a-bb57-5ab0a1e69873	หมู่บ้าน NB056	50	Demo NB056	หมู่บ้าน NB056	Demo NB056	2017-05-26 14:12:27	2017-05-26 14:12:27	\N	\N
1b4176c6-c83b-4f61-b6ae-9679aa64f364	หมู่บ้าน NB048	50	Demo NB048	หมู่บ้าน NB048	Demo NB048	2017-05-26 14:12:23	2017-06-03 17:11:50	\N	\N
89536d7b-7fed-436a-848c-9ff2edfdec33	หมู่บ้าน NB047	50	Demo NB047	หมู่บ้าน NB047	Demo NB047	2017-05-26 14:12:23	2017-05-26 14:12:23	\N	\N
21a133e1-65b2-4e7e-8a40-b9a0e700a5f4	หมู่บ้าน NB049	50	Demo NB049	หมู่บ้าน NB049	Demo NB049	2017-05-26 14:12:24	2017-05-26 14:12:24	\N	\N
923249fa-0616-4575-a92d-4bbfa97ad513	หมู่บ้าน NB052	50	Demo NB052	หมู่บ้าน NB052	Demo NB052	2017-05-26 14:12:25	2017-05-26 14:12:25	\N	\N
9d2db57f-1556-4d94-b32b-a03f1e2cdc54	หมู่บ้าน NB053	50	Demo NB053	หมู่บ้าน NB053	Demo NB053	2017-05-26 14:12:26	2017-05-26 14:12:26	\N	\N
941bfffd-8dfa-4de5-93c0-6f3d4de9a6a2	หมู่บ้าน NB059	50	Demo NB059	หมู่บ้าน NB059	Demo NB059	2017-05-26 14:12:29	2017-05-26 14:12:29	\N	\N
60c36acd-4fc5-4527-a366-ce2590e7c3c7	หมู่บ้าน NB050	50	Demo NB050	หมู่บ้าน NB050	Demo NB050	2017-05-26 14:12:24	2017-06-15 12:30:59	\N	\N
ff9c697d-1eab-40d5-8b85-7851461b262f	หมู่บ้าน NB051	50	Demo NB051	หมู่บ้าน NB051	Demo NB051	2017-05-26 14:12:25	2017-06-16 19:07:46	\N	\N
ed2af145-244f-4225-88b3-0d0821a59e8c	คอนโดศุภาลัย ปาร์ค แยกเกษตร	50	Demo NB057	คอนโดศุภาลัย ปาร์ค แยกเกษตร	Demo NB057	2017-05-26 14:12:27	2017-07-06 13:50:19	\N	\N
4f1f273a-8686-4f99-b94c-55be384195cf	นิติ Sogood Village 1	50	Sogood Village 1	Sogood Village 1	Sogood Village 1	2017-05-26 14:12:28	2017-07-07 07:47:25	\N	\N
475058ae-e51a-4c2a-9550-1797c2b62209	หมู่บ้าน NB055	50	Demo NB055	หมู่บ้าน NB055	Demo NB055	2017-05-26 14:12:27	2017-07-08 07:45:24	\N	\N
91507561-6c91-4ba9-85c6-a264199a8876	หมู่บ้าน NB065	50	Demo NB065	หมู่บ้าน NB065	Demo NB065	2017-05-26 14:12:34	2017-05-26 14:12:34	\N	\N
511e9719-f574-47e8-92d2-3fcfe9f106f9	หมู่บ้าน NB072	50	Demo NB072	หมู่บ้าน NB072	Demo NB072	2017-06-02 10:51:09	2017-06-02 10:51:09	\N	\N
87219ffc-be33-4f9f-905e-076cedf9e375	หมู่บ้าน NB073	50	Demo NB073	หมู่บ้าน NB073	Demo NB073	2017-06-02 10:51:10	2017-06-02 10:51:10	\N	\N
2c2dfb1b-73b0-4762-9d15-78e319220d5a	หมู่บ้าน NB067	50	Demo NB067	หมู่บ้าน NB067	Demo NB067	2017-06-02 10:51:06	2017-06-02 10:51:06	\N	\N
d2025f9f-ece7-438d-a3da-9a2124440185	หมู่บ้าน NB068	50	Demo NB068	หมู่บ้าน NB068	Demo NB068	2017-06-02 10:51:07	2017-06-02 10:51:07	\N	\N
129ce565-04e5-47fd-9552-3a5691108f05	หมู่บ้าน NB069	50	Demo NB069	หมู่บ้าน NB069	Demo NB069	2017-06-02 10:51:08	2017-06-02 10:51:08	\N	\N
dcf93455-2848-40c9-af29-b43b64bf128c	หมู่บ้าน NB074	50	Demo NB074	หมู่บ้าน NB074	Demo NB074	2017-06-02 10:51:11	2017-06-02 10:51:11	\N	\N
841da8c2-bb12-4132-92ad-a561d5a786a8	หมู่บ้าน NB070	50	Demo NB070	หมู่บ้าน NB070	Demo NB070	2017-06-02 10:51:08	2017-06-02 10:51:08	\N	\N
5fe871bb-5079-460f-9982-d4f628806d77	หมู่บ้าน NB071	50	Demo NB071	หมู่บ้าน NB071	Demo NB071	2017-06-02 10:51:08	2017-06-02 10:51:08	\N	\N
83c061de-a229-4cfd-8221-f807361b466e	หมู่บ้าน NB075	50	Demo NB075	หมู่บ้าน NB075	Demo NB075	2017-06-02 10:51:11	2017-06-02 10:51:11	\N	\N
51413e82-3b5e-4019-b2c8-1ad5d90d29c7	หมู่บ้าน NB076	50	Demo NB076	หมู่บ้าน NB076	Demo NB076	2017-06-02 10:51:11	2017-06-02 10:51:11	\N	\N
b3fc305b-898e-4244-b491-d5ffcc571aab	หมู่บ้าน NB066	50	Demo NB066	หมู่บ้าน NB066	Demo NB066	2017-05-26 14:12:35	2017-08-04 11:28:09	\N	\N
f3789c6c-21c8-4acc-aea5-7615a814592d	หมู่บ้าน NB064	50	Demo NB064	หมู่บ้าน NB064	Demo NB064	2017-05-26 14:12:33	2017-08-23 16:35:11	\N	\N
2bdda7ad-3131-4e60-b499-b6f639ed128d	หมู่บ้าน NB060	50	Demo NB060	หมู่บ้าน NB060	Demo NB060	2017-05-26 14:12:30	2017-10-19 12:33:57	\N	\N
7d08633d-d146-49cf-b259-76841f5f7ae3	หมู่บ้าน NB077	50	Demo NB077	หมู่บ้าน NB077	Demo NB077	2017-06-02 10:51:12	2017-06-02 10:51:12	\N	\N
c92cc1ba-74e3-4600-baf3-6ae944cf9b8d	หมู่บ้าน NB078	50	Demo NB078	หมู่บ้าน NB078	Demo NB078	2017-06-02 10:51:13	2017-06-02 10:51:13	\N	\N
21e29594-133e-4ba5-b19e-07e766e651cd	หมู่บ้าน NB079	50	Demo NB079	หมู่บ้าน NB079	Demo NB079	2017-06-02 10:51:14	2017-06-02 10:51:14	\N	\N
1d73bddd-a9f5-49af-8c7b-935aaf63f9ab	หมู่บ้าน NB080	50	Demo NB080	หมู่บ้าน NB080	Demo NB080	2017-06-02 10:51:15	2017-06-02 10:51:15	\N	\N
68208e19-a0e2-4161-95fc-b9a860495b4f	หมู่บ้าน NB081	50	Demo NB081	หมู่บ้าน NB081	Demo NB081	2017-06-02 10:51:16	2017-06-02 10:51:16	\N	\N
8aa88013-d5d3-40d2-855e-da0be752cb06	หมู่บ้าน NB082	50	Demo NB082	หมู่บ้าน NB082	Demo NB082	2017-06-02 10:51:16	2017-06-02 10:51:16	\N	\N
ac3182f5-ee9e-4735-a0f5-6d9441416fb8	หมู่บ้าน NB083	50	Demo NB083	หมู่บ้าน NB083	Demo NB083	2017-06-02 10:51:17	2017-06-02 10:51:17	\N	\N
c1486782-9f6e-44da-a25f-c2c7b213df68	หมู่บ้าน NB084	50	Demo NB084	หมู่บ้าน NB084	Demo NB084	2017-06-02 10:51:18	2017-06-02 10:51:18	\N	\N
af0b5c0b-024c-4c21-bbaa-44ae6d5b1d99	หมู่บ้าน NB085	50	Demo NB085	หมู่บ้าน NB085	Demo NB085	2017-06-02 10:51:19	2017-06-02 10:51:19	\N	\N
6892218a-e039-41ed-9d73-06cdd9cf61da	หมู่บ้าน NB086	50	Demo NB086	หมู่บ้าน NB086	Demo NB086	2017-06-02 10:51:19	2017-06-02 10:51:19	\N	\N
b57ce901-abfc-4f54-b903-e98f96a2a227	นิติบุคคลเนเบอร์เวิร์คชอป คอนโด	50	Juristic person Nabour Workshop Condominium	เนเบอร์เวิร์คชอป คอนโด	Nabour Workshop Condominium	2017-06-12 10:14:29	2017-07-31 15:38:32	\N	\N
ee68dca5-0f4b-4eaf-a58b-dd6526cc6103	หมู่บ้าน NB099	50	Demo NB099	หมู่บ้าน NB099	Demo NB099	2017-07-04 16:04:43	2017-07-04 16:04:43	\N	\N
3c8e1a1a-06f9-4c20-a327-3988e84fab23	หมู่บ้าน NB100	50	Demo NB100	หมู่บ้าน NB100	Demo NB100	2017-07-04 16:04:44	2017-07-04 16:04:44	\N	\N
d433df56-0e46-4b7a-88c3-0544159a5059	หมู่บ้าน NB101	50	Demo NB101	หมู่บ้าน NB101	Demo NB101	2017-07-04 16:04:44	2017-07-04 16:04:44	\N	\N
62c700e1-c665-482b-a48b-9ea456f050b6	นิติบุคคลหมู่บ้านจัดสรรอารียา บุษบา	10	Areeya Bussaba Housing estate juristic person	อารียา บุษบา ลาดพร้าว	AREEYA BUSSABA LADPRAO	2016-01-08 17:23:10	2017-06-13 10:32:24	\N	\N
be1c087d-c21b-4f61-bc53-7ec19797d623	เดอะแกลเลอร์รี่เฮาส์ แพทเทิร์น	10	The Gallery House Pattern	เดอะแกลเลอร์รี่เฮาส์ แพทเทิร์น	The Gallery House Pattern	2017-06-27 09:57:16	2017-06-27 09:57:16	\N	\N
1d8a7581-6c89-4dad-99fc-37e768031872	หมู่บ้าน NB087	50	Demo NB087	หมู่บ้าน NB087	Demo NB087	2017-07-04 16:04:33	2017-07-04 16:04:33	\N	\N
04f8a2ae-c16c-4c69-8957-a38e7bfd9a4f	หมู่บ้าน NB088	50	Demo NB088	หมู่บ้าน NB088	Demo NB088	2017-07-04 16:04:34	2017-07-04 16:04:34	\N	\N
77efdce6-996b-48c5-b1b4-82684d72857b	หมู่บ้าน NB089	50	Demo NB089	หมู่บ้าน NB089	Demo NB089	2017-07-04 16:04:34	2017-07-04 16:04:34	\N	\N
ab431fd7-2c0a-4fed-8cb1-b7c6ce58b66b	หมู่บ้าน NB090	50	Demo NB090	หมู่บ้าน NB090	Demo NB090	2017-07-04 16:04:35	2017-07-04 16:04:35	\N	\N
ade3b7d5-49c1-482c-85e1-a0e55880ca14	หมู่บ้าน NB091	50	Demo NB091	หมู่บ้าน NB091	Demo NB091	2017-07-04 16:04:36	2017-07-04 16:04:36	\N	\N
52f61601-d00c-41d2-bcd9-ddf3986ad985	หมู่บ้าน NB092	50	Demo NB092	หมู่บ้าน NB092	Demo NB092	2017-07-04 16:04:37	2017-07-04 16:04:37	\N	\N
db2fd134-5b31-41f4-87f2-608c5fd51faf	หมู่บ้าน NB093	50	Demo NB093	หมู่บ้าน NB093	Demo NB093	2017-07-04 16:04:38	2017-07-04 16:04:38	\N	\N
eee17868-eb9c-4ce4-a3e9-ca0f11a823d1	หมู่บ้าน NB094	50	Demo NB094	หมู่บ้าน NB094	Demo NB094	2017-07-04 16:04:39	2017-07-04 16:04:39	\N	\N
ad9d7a4b-702b-4872-bc95-82a24b3de6ea	หมู่บ้าน NB095	50	Demo NB095	หมู่บ้าน NB095	Demo NB095	2017-07-04 16:04:40	2017-07-04 16:04:40	\N	\N
d8cf70f5-2629-4df9-a040-2b84221861e9	หมู่บ้าน NB096	50	Demo NB096	หมู่บ้าน NB096	Demo NB096	2017-07-04 16:04:41	2017-07-04 16:04:41	\N	\N
c933f6bf-3c8c-43b2-a0ca-fcdfb4c59be2	หมู่บ้าน NB097	50	Demo NB097	หมู่บ้าน NB097	Demo NB097	2017-07-04 16:04:42	2017-07-04 16:04:42	\N	\N
32b5361d-6139-4690-ac6b-a14c9550a8ad	หมู่บ้าน NB098	50	Demo NB098	หมู่บ้าน NB098	Demo NB098	2017-07-04 16:04:42	2017-07-04 16:04:42	\N	\N
fd546358-a5f2-4a4b-b2e2-acbfa74fb090	หมู่บ้าน NB102	50	Demo NB102	หมู่บ้าน NB102	Demo NB102	2017-07-04 16:04:45	2017-07-04 16:04:45	\N	\N
6d8b49c3-8552-4617-b059-d838d823728b	หมู่บ้าน NB103	50	Demo NB103	หมู่บ้าน NB103	Demo NB103	2017-07-04 16:04:45	2017-07-04 16:04:45	\N	\N
03a09174-6a3c-422e-86f2-2166b2f84307	หมู่บ้าน NB104	50	Demo NB104	หมู่บ้าน NB104	Demo NB104	2017-07-04 16:04:46	2017-07-04 16:04:46	\N	\N
b7319d70-769d-41d2-92a8-2cf545ebe981	หมู่บ้าน NB105	50	Demo NB105	หมู่บ้าน NB105	Demo NB105	2017-07-04 16:04:46	2017-07-04 16:04:46	\N	\N
f249ba99-fc0b-4f70-8dad-8dcfdfb5468d	หมู่บ้าน NB106	50	Demo NB106	หมู่บ้าน NB106	Demo NB106	2017-07-04 16:04:47	2017-07-04 16:04:47	\N	\N
498fbfdd-19f5-4b51-aa05-e23f832a4bf8	หมู่บ้าน NB107	50	Demo NB107	หมู่บ้าน NB107	Demo NB107	2017-07-04 16:10:27	2017-07-04 16:10:27	\N	\N
59f764fc-2e01-414a-86cb-e6f98b2b3638	หมู่บ้าน NB108	50	Demo NB108	หมู่บ้าน NB108	Demo NB108	2017-07-04 16:10:27	2017-07-04 16:10:27	\N	\N
7777fe87-2481-4df6-88d7-7424276de6fe	หมู่บ้าน NB109	50	Demo NB109	หมู่บ้าน NB109	Demo NB109	2017-07-04 16:10:28	2017-07-04 16:10:28	\N	\N
ae0f4fdc-72c1-440c-8a18-cdae258d3c51	หมู่บ้าน NB110	50	Demo NB110	หมู่บ้าน NB110	Demo NB110	2017-07-04 16:10:29	2017-07-04 16:10:29	\N	\N
36c276c4-afab-4ad5-9c24-b448b068a267	หมู่บ้าน NB111	50	Demo NB111	หมู่บ้าน NB111	Demo NB111	2017-07-04 16:10:30	2017-07-04 16:10:30	\N	\N
76893a62-70e9-4649-b41d-20104389333a	หมู่บ้าน NB112	50	Demo NB112	หมู่บ้าน NB112	Demo NB112	2017-07-04 16:10:31	2017-07-04 16:10:31	\N	\N
2ffb0340-9770-4c21-b799-32f3b75d196e	หมู่บ้าน NB113	50	Demo NB113	หมู่บ้าน NB113	Demo NB113	2017-07-04 16:10:32	2017-07-04 16:10:32	\N	\N
74c84f5c-2362-46bf-9962-746eb2dda6ad	หมู่บ้าน NB114	50	Demo NB114	หมู่บ้าน NB114	Demo NB114	2017-07-04 16:10:33	2017-07-04 16:10:33	\N	\N
5a02c98b-997e-4aed-9535-baea599f855b	หมู่บ้าน NB115	50	Demo NB115	หมู่บ้าน NB115	Demo NB115	2017-07-04 16:10:34	2017-07-04 16:10:34	\N	\N
d498ccdd-2ff8-42a3-8a32-6aa74bee8a1a	หมู่บ้าน NB116	50	Demo NB116	หมู่บ้าน NB116	Demo NB116	2017-07-04 16:10:35	2017-07-04 16:10:35	\N	\N
164733d2-5b22-4efb-935e-611e01dc25bc	หมู่บ้าน NB117	50	Demo NB117	หมู่บ้าน NB117	Demo NB117	2017-07-04 16:10:36	2017-07-04 16:10:36	\N	\N
f2dad793-3b3a-435e-90a1-3d0fac84d0a3	หมู่บ้าน NB118	50	Demo NB118	หมู่บ้าน NB118	Demo NB118	2017-07-04 16:10:37	2017-07-04 16:10:37	\N	\N
5afaf493-fda4-47c7-af14-24034ad0e2af	หมู่บ้าน NB119	50	Demo NB119	หมู่บ้าน NB119	Demo NB119	2017-07-04 16:10:38	2017-07-04 16:10:38	\N	\N
0abf4092-15eb-4e0a-8a43-a1bcc83c5ee3	หมู่บ้าน NB120	50	Demo NB120	หมู่บ้าน NB120	Demo NB120	2017-07-04 16:10:39	2017-07-04 16:10:39	\N	\N
176fd750-a20e-42df-9b49-00c22737b09f	หมู่บ้าน NB121	50	Demo NB121	หมู่บ้าน NB121	Demo NB121	2017-07-04 16:10:40	2017-07-04 16:10:40	\N	\N
a9572a45-d8e3-468b-be25-3ab4554039e9	หมู่บ้าน NB122	50	Demo NB122	หมู่บ้าน NB122	Demo NB122	2017-07-04 16:10:40	2017-07-04 16:10:40	\N	\N
99ccecf4-e219-4773-b4ae-7a4c9d8cfb2e	หมู่บ้าน NB123	50	Demo NB123	หมู่บ้าน NB123	Demo NB123	2017-07-04 16:10:41	2017-07-04 16:10:41	\N	\N
635ff499-5935-4759-9943-de973583926b	หมู่บ้าน NB124	50	Demo NB124	หมู่บ้าน NB124	Demo NB124	2017-07-04 16:10:42	2017-07-04 16:10:42	\N	\N
ceec393f-30b0-4c02-b596-74ecc81dfdde	หมู่บ้าน NB125	50	Demo NB125	หมู่บ้าน NB125	Demo NB125	2017-07-04 16:10:43	2017-07-04 16:10:43	\N	\N
5a4f8a92-f0eb-4c9b-bc1c-2ae669850d5b	หมู่บ้าน NB126	50	Demo NB126	หมู่บ้าน NB126	Demo NB126	2017-07-04 16:10:44	2017-07-04 16:10:44	\N	\N
6dc315c4-788a-44a3-84a3-f1adfc613264	หมู่บ้าน NB137	50	Demo NB137	หมู่บ้าน NB137	Demo NB137	2017-08-05 19:53:21	2017-08-05 19:53:21	\N	\N
5a46380a-fb6c-400f-b7dd-686a69b83fcf	ทดสอบ	10	ทดสอบ	ทดสอบ	ทดสอบ	2017-07-06 22:31:18	2017-07-06 22:31:18	\N	\N
b0eaeadd-5a72-41f1-ad5c-cc42b7b0a129	หมู่บ้าน NB138	50	Demo NB138	หมู่บ้าน NB138	Demo NB138	2017-08-05 19:53:22	2017-08-05 19:53:22	\N	\N
5bf7f409-ba8c-436e-bb8a-2f190ed8ec57	หมู่บ้าน NB128	50	Demo NB128	หมู่บ้าน NB128	Demo NB128	2017-08-05 19:53:16	2017-08-05 19:53:16	\N	\N
e6b5beae-905c-4d9f-9b09-e8822ecb4f98	หมู่บ้าน NB129	50	Demo NB129	หมู่บ้าน NB129	Demo NB129	2017-08-05 19:53:17	2017-08-05 19:53:17	\N	\N
974c5f31-aec7-4b55-a2b4-87490f1be063	หมู่บ้าน NB131	50	Demo NB131	หมู่บ้าน NB131	Demo NB131	2017-08-05 19:53:18	2017-08-17 14:29:31	\N	\N
b8c534bf-4678-437b-a0d3-a8077bcb282f	หมู่บ้าน NB130	50	Demo NB130	หมู่บ้าน NB130	Demo NB130	2017-08-05 19:53:18	2017-08-05 19:53:18	\N	\N
5de54ae8-59aa-4e54-b282-46223ee1eebb	หมู่บ้าน NB127	50	Demo NB127	หมู่บ้าน NB127	Demo NB127	2017-08-05 19:53:15	2017-08-05 19:53:15	\N	\N
27f05462-d3ba-4520-bf22-f1c5057dbc03	หมู่บ้าน NB134	50	Demo NB134	หมู่บ้าน NB134	Demo NB134	2017-08-05 19:53:20	2017-08-05 19:53:20	\N	\N
27f3a974-d945-461a-b6b3-0e7aa27c99b9	หมู่บ้าน NB135	50	Demo NB135	หมู่บ้าน NB135	Demo NB135	2017-08-05 19:53:20	2017-08-05 19:53:20	\N	\N
6b6f20bb-aee1-48f4-b01d-679ce39079c7	หมู่บ้าน NB132	50	Demo NB132	หมู่บ้าน NB132	Demo NB132	2017-08-05 19:53:19	2017-08-18 13:55:24	\N	\N
341310c6-2c80-4560-aac8-dcff05c4749b	หมู่บ้าน NB139	50	Demo NB139	หมู่บ้าน NB139	Demo NB139	2017-08-05 19:53:22	2017-08-05 19:53:22	\N	\N
da02539b-b498-4adf-a637-ff6fe4e83e5c	หมู่บ้าน NB140	50	Demo NB140	หมู่บ้าน NB140	Demo NB140	2017-08-05 19:53:23	2017-08-05 19:53:23	\N	\N
b284c601-17a2-4a88-bbda-d494d2220633	หมู่บ้าน NB141	50	Demo NB141	หมู่บ้าน NB141	Demo NB141	2017-08-05 19:53:24	2017-08-05 19:53:24	\N	\N
1461bfe1-d3c5-4ff5-b9a7-335def7a16c4	หมู่บ้าน NB142	50	Demo NB142	หมู่บ้าน NB142	Demo NB142	2017-08-05 19:53:24	2017-08-05 19:53:24	\N	\N
05b7a9ac-4719-4fa6-a9ac-8125eb3b4b91	หมู่บ้าน NB143	50	Demo NB143	หมู่บ้าน NB143	Demo NB143	2017-08-05 19:53:25	2017-08-05 19:53:25	\N	\N
a5107489-2ab8-48eb-8b36-6ff33283e055	หมู่บ้าน NB144	50	Demo NB144	หมู่บ้าน NB144	Demo NB144	2017-08-05 19:53:25	2017-08-05 19:53:25	\N	\N
a953a54f-1934-4ab5-bb28-a91de2bbca21	หมู่บ้าน NB145	50	Demo NB145	หมู่บ้าน NB145	Demo NB145	2017-08-05 19:53:26	2017-08-05 19:53:26	\N	\N
4840e056-f444-41dc-9d36-53fe6f36e177	หมู่บ้าน NB136	50	Demo NB136	หมู่บ้าน NB136	Demo NB136	2017-08-05 19:53:21	2017-09-19 00:42:32	\N	\N
dd3203e7-8a9f-42b2-b512-0e424edcf21e	หมู่บ้าน NB146	50	Demo NB146	หมู่บ้าน NB146	Demo NB146	2017-08-05 19:53:26	2017-08-05 19:53:26	\N	\N
ae0aba6b-3d3e-462c-9f2d-be22d704bcf6	หมู่บ้าน NB164	50	Demo NB164	หมู่บ้าน NB164	Demo NB164	2017-10-03 15:23:53	2017-10-03 15:23:53	\N	\N
89ec2469-9fba-444b-a001-7062e50366eb	หมู่บ้าน NB165	50	Demo NB165	หมู่บ้าน NB165	Demo NB165	2017-10-03 15:23:53	2017-10-03 15:23:53	\N	\N
6a5f455e-d1dd-42e6-964b-a95d09c52799	หมู่บ้าน NB166	50	Demo NB166	หมู่บ้าน NB166	Demo NB166	2017-10-03 15:23:54	2017-10-03 15:23:54	\N	\N
3583d766-4ec1-4ff5-9bdc-188478e1d8a7	หมู่บ้าน NB162	50	Demo NB162	หมู่บ้าน NB162	Demo NB162	2017-10-03 15:23:51	2017-10-03 15:23:51	\N	\N
67282a84-ae1e-4f3c-910f-47bad79b1e44	หมู่บ้าน NB163	50	Demo NB163	หมู่บ้าน NB163	Demo NB163	2017-10-03 15:23:52	2017-10-03 15:23:52	\N	\N
a6c04ec9-ea12-4fc1-ada0-53b666c08b06	หมู่บ้าน NB063	50	Demo NB063	หมู่บ้าน NB063	Demo NB063	2017-05-26 14:12:32	2017-09-13 16:24:47	\N	\N
74929d15-317c-4c93-bbe7-5766f8d2bf08	หมู่บ้าน NB170	50	Demo NB170	หมู่บ้าน NB170	Demo NB170	2017-10-03 15:25:03	2017-10-03 15:25:03	\N	\N
f524e6bf-67b1-487c-969f-13c96679a497	หมู่บ้าน NB167	50	Demo NB167	หมู่บ้าน NB167	Demo NB167	2017-10-03 15:25:00	2017-10-03 16:24:30	\N	\N
bff7ce0e-c3ea-4808-bf2c-4c9b30c8b901	หมู่บ้าน NB173	50	Demo NB173	หมู่บ้าน NB173	Demo NB173	2017-10-03 15:25:05	2017-10-03 15:25:05	\N	\N
eb676710-dae7-4b70-b560-c1963b8e4c75	หมู่บ้าน NB133	50	Demo NB133	หมู่บ้าน NB133	Demo NB133	2017-08-05 19:53:19	2018-06-27 18:36:44	\N	\N
3281ecd9-5b45-4488-b31c-231cee1edfc6	นิติบุคคลหมู่บ้านจัดสรรศุภาลัย การ์เด้น วิลล์ บางแสน	20	Supalai Garden Ville Bangsean Juristic Person	หมู่บ้านศุภาลัย การ์เด้น วิลล์ บางแสน	Supalai Garden Ville Bangsean	2017-07-24 12:27:10	2018-07-08 17:05:57	\N	\N
91bb9ca7-a443-4aac-b0b9-92ebfa03e8a2	หมู่บ้าน NB175	50	Demo NB175	หมู่บ้าน NB175	Demo NB175	2017-10-03 15:25:07	2017-10-03 15:25:07	\N	\N
cda56fc2-d911-4dff-b248-17d8edbbb002	หมู่บ้าน NB176	50	Demo NB176	หมู่บ้าน NB176	Demo NB176	2017-10-03 15:25:07	2017-10-03 15:25:07	\N	\N
43c2d8c0-0aa8-4674-9c47-a2be63a87011	หมู่บ้าน NB177	50	Demo NB177	หมู่บ้าน NB177	Demo NB177	2017-10-03 15:25:08	2017-10-03 15:25:08	\N	\N
fd50515d-a3dc-4c63-bc31-76128c8bc978	หมู่บ้าน NB168	50	Demo NB168	หมู่บ้าน NB168	Demo NB168	2017-10-03 15:25:01	2017-10-03 16:24:52	\N	\N
a3cfa088-5ed9-408e-a027-3cd7e0a8a4dc	หมู่บ้าน NB178	50	Demo NB178	หมู่บ้าน NB178	Demo NB178	2017-10-03 15:25:09	2017-10-03 15:25:09	\N	\N
c719a8a7-98cd-410a-996c-1c28b91f0214	หมู่บ้าน NB179	50	Demo NB179	หมู่บ้าน NB179	Demo NB179	2017-10-03 15:25:10	2017-10-03 15:25:10	\N	\N
0005d3f7-2403-49db-bb4a-dbf7fb7ac980	หมู่บ้าน NB180	50	Demo NB180	หมู่บ้าน NB180	Demo NB180	2017-10-03 15:25:11	2017-10-03 15:25:11	\N	\N
2237e293-5289-444e-9f12-bce42134a65c	หมู่บ้าน NB181	50	Demo NB181	หมู่บ้าน NB181	Demo NB181	2017-10-03 15:25:12	2017-10-03 15:25:12	\N	\N
0ba21182-352c-4ae9-ad02-fea02b6877cf	ป๊อปปูล่าคอนโด อาคาร T1	12	Popular Condo T1	ป๊อปปูล่าคอนโด	Popular Condo 	2017-04-04 14:07:18	2017-12-18 15:49:27	\N	\N
c511beec-b8fe-4bdd-a9ab-071ac8554950	หมู่บ้าน NB169	50	Demo NB169	หมู่บ้าน NB169	Demo NB169	2017-10-03 15:25:02	2017-11-17 04:09:56	\N	\N
d61e3575-8c18-458e-a8f6-23f046a9adcd	หมู่บ้าน NB171	50	Demo NB171	หมู่บ้าน NB171	Demo NB171	2017-10-03 15:25:03	2017-11-22 10:20:21	\N	\N
521cd3aa-b1f1-437f-9ad2-84288051d219	หมู่บ้าน NB172	50	Demo NB172	หมู่บ้าน NB172	Demo NB172	2017-10-03 15:25:04	2018-01-24 15:56:12	\N	\N
67aa71ef-deb5-4fed-998b-0dc2972d6c7d	หมู่บ้าน NB182	50	Demo NB182	หมู่บ้าน NB182	Demo NB182	2017-10-03 15:25:12	2017-10-03 15:25:12	\N	\N
5c60c76d-f213-4f29-b2a8-6f50bdff6d3d	หมู่บ้าน NB183	50	Demo NB183	หมู่บ้าน NB183	Demo NB183	2017-10-03 15:25:13	2017-10-03 15:25:13	\N	\N
5f39523d-732d-4121-9dca-541e2d9ad61d	หมู่บ้าน NB184	50	Demo NB184	หมู่บ้าน NB184	Demo NB184	2017-10-03 15:25:14	2017-10-03 15:25:14	\N	\N
1cba0adc-c0ab-43de-b014-92ac5a7e1398	นิติบุคคลอาคารชุด เดอะ คอร์ทยาร์ค เขาใหญ่	30	-	-	-	2017-04-05 15:30:03	2017-09-14 09:40:13	\N	\N
868d3fb4-0a98-43d8-922d-8c72024a9293	หมู่บ้าน NB185	50	Demo NB185	หมู่บ้าน NB185	Demo NB185	2017-10-03 15:25:15	2017-10-03 15:25:15	\N	\N
63665423-e9c5-4510-89d5-2576e71b81d1	หมู่บ้าน NB186	50	Demo NB186	หมู่บ้าน NB186	Demo NB186	2017-10-03 15:25:15	2017-10-03 15:25:15	\N	\N
283ae316-bffe-4129-8b31-e866ad50d935	หมู่บ้าน NB147	50	Demo NB147	หมู่บ้าน NB147	Demo NB147	2017-10-03 15:23:39	2017-10-03 15:23:39	\N	\N
48212be9-6623-4024-a6ed-b263e2bc5281	หมู่บ้าน NB148	50	Demo NB148	หมู่บ้าน NB148	Demo NB148	2017-10-03 15:23:40	2017-10-03 15:23:40	\N	\N
639fac8e-60bd-4051-8575-6e96a5b59e70	หมู่บ้าน NB149	50	Demo NB149	หมู่บ้าน NB149	Demo NB149	2017-10-03 15:23:40	2017-10-03 15:23:40	\N	\N
f4639e1a-f442-4b8c-97de-85de98f01afd	หมู่บ้าน NB150	50	Demo NB150	หมู่บ้าน NB150	Demo NB150	2017-10-03 15:23:41	2017-10-03 15:23:41	\N	\N
d1ef5209-e9ca-4ab1-b727-8038612091f0	หมู่บ้าน NB151	50	Demo NB151	หมู่บ้าน NB151	Demo NB151	2017-10-03 15:23:42	2017-10-03 15:23:42	\N	\N
173cbac1-f987-4590-85db-c13eddb8ed52	หมู่บ้าน NB152	50	Demo NB152	หมู่บ้าน NB152	Demo NB152	2017-10-03 15:23:43	2017-10-03 15:23:43	\N	\N
195ead2c-2a02-4c3d-8dfb-dd96c0acaf3a	หมู่บ้าน NB158	50	Demo NB158	หมู่บ้าน NB158	Demo NB158	2017-10-03 15:23:48	2017-10-03 15:23:48	\N	\N
96d57c15-04aa-4052-bdab-628d0f6ec9e1	หมู่บ้าน NB154	50	Demo NB154	หมู่บ้าน NB154	Demo NB154	2017-10-03 15:23:44	2017-10-03 15:23:44	\N	\N
7067ae38-ad90-4be7-80ea-174e98df1a2b	หมู่บ้าน NB155	50	Demo NB155	หมู่บ้าน NB155	Demo NB155	2017-10-03 15:23:45	2017-10-03 15:23:45	\N	\N
8e139c20-01d2-4bb8-999f-448a3b7a87aa	หมู่บ้าน NB157	50	Demo NB157	หมู่บ้าน NB157	Demo NB157	2017-10-03 15:23:47	2018-04-27 15:46:19	\N	\N
e6cda533-70a3-4ffa-8858-b266fa83d2ec	หมู่บ้าน NB159	50	Demo NB159	หมู่บ้าน NB159	Demo NB159	2017-10-03 15:23:49	2018-06-18 20:36:26	\N	\N
ba30c1f7-fb9a-44f6-a20c-2caab7b2367d	หมู่บ้าน NB160	50	Demo NB160	หมู่บ้าน NB160	Demo NB160	2017-10-03 15:23:49	2018-06-12 09:26:55	\N	\N
82ed9afb-af7d-434d-9c5f-249413aa7368	โครงการ NABOUR 	10	โครงการ NABOUR 	โครงการ NABOUR 	โครงการ NABOUR 	2017-11-01 11:21:48	2018-01-18 11:01:51	\N	\N
529123bf-0de6-4185-befa-fe725c5d1ebf	นิติบุคคลอาคารชุด กัลปพฤกษ์ แกรนด์ นครศรีธรรมราช	80	kalllpaphruk Grand Nakhon Si Thammarat	กัลปพฤกษ์ แกรนด์ นครศรีธรรมราช	kalllpaphruk Grand Nakhon Si Thammarat	2017-11-10 13:51:37	2018-07-06 15:58:20	\N	\N
b31860f5-cb16-4994-b02a-26461d244968	นิติบุคคลอาคารชุด กัลปพฤกษ์ ซิตี้ พลัส พิษณุโลก	65	Kallapaphruk City Plus Phitsanulok Juristic Person	กัลปพฤกษ์ ซิตี้ พลัส พิษณุโลก	Kallapaphruk City Plus Phitsanulok	2017-11-09 11:00:17	2018-07-08 11:25:38	\N	\N
d118f8c6-f0ed-4b48-8c40-c108ede53dd1	นิติบุคคลอาคารชุด เดอะ คอร์ทยาร์ด เขาใหญ่ เอ	30	The Courtyard Khao Yai A	เดอะ คอร์ทยาร์ด เขาใหญ่ เอ	The Courtyard Khao Yai A	2017-11-20 17:30:46	2018-07-08 11:51:59	\N	\N
d59a992d-48a4-4fdf-9b1f-948b81fd193c	หมู่บ้าน NB161	50	Demo NB161	หมู่บ้าน NB161	Demo NB161	2017-10-03 15:23:50	2018-07-04 20:44:08	\N	\N
c7212c6f-ca97-466f-b024-2a41b8ae59d4	นิติบุคคลอาคารชุด พาร์ค คอนโดดรีม พิษณุโลก	65	Park Condo Dream phitsanulok	นิติบุคคลอาคารชุด พาร์ค คอนโดดรีม พิษณุโลก	Park Condo Dream phitsanulok	2017-11-09 10:55:20	2018-07-08 14:11:19	\N	\N
a052496d-a365-40f8-8619-f341e6298114	นิติบุคคลอาคารชุด เดอะ คอร์ทยาร์ด เขาใหญ่ บี	30	The Courtyard Khao Yai B	นิติบุคคลอาคาร ชุด เดอะ คอร์ทยาร์ด เขาใหญ่ บี	The Courtyard Khao Yai B	2017-11-20 17:36:14	2018-07-07 10:11:41	\N	\N
1ce48329-b39a-439c-8573-fe53bb612cfc	กัลปพฤกษ์เลควิวขอนแก่น บี	40	Kanlapapruek Lake View Khon Kaen B	กัลปพฤกษ์เลควิวขอนแก่น บี	Kanlapapruek Lake View Khon Kaen B	2017-11-20 18:08:23	2018-07-06 15:18:50	\N	\N
41a6f71b-d515-4218-bd9d-89771188fd8f	นิติบุคคลเซ็นทริค อารีย์ คอนโดมิเนียม	10	Centric Ari Condominium Juristic Person	เซ็นทริค อารีย์ คอนโดมิเนียม	Centric Ari Condominium	2017-12-13 10:09:58	2018-01-18 10:37:44	\N	\N
ca46a730-bffc-4ed1-ae4b-29fd34f862c6	นิติบุคคลบ้านจัดสรร บ้านอาภากร 2	73	Aparkorn 2 Housing Estate Juristic Person	หมู่บ้านอาภากร 2	Aparkorn 2 Village	2017-10-03 15:23:44	2018-01-03 15:29:17	\N	\N
1d196776-af22-4172-a3de-b4305b9ae0db	บ้านอยู่สบายสนามกีฬา	73	Banyusabai Sanamgeela	บ้านอยู่สบายสนามกีฬา	Banyusabai Sanamgeela	2018-01-15 16:17:19	2018-03-03 18:21:06	\N	\N
746f5245-2c8a-4779-9f9d-32b1549d5f88	นิติบุคคลอาคารชุด เอส คอนโด สมุทรสาคร อาคาร B	74	S Cond Samut Sakhon Building B	เอส คอนโด สมุทรสาคร อาคาร B	S Cond Samut Sakhon Building B	2018-01-11 19:45:38	2018-07-05 15:43:12	\N	\N
53333c32-14ec-4d67-987a-26b6f8dc4f09	นิติบุคคลอาคารชุด เอส คอนโด สมุทรสาคร อาคาร A	74	S Condo Samut Sakhon Building A	เอส คอนโด สมุทรสาคร อาคาร A	S Condo Samut Sakhon Building A	2018-01-11 19:32:15	2018-07-05 15:41:51	\N	\N
2502abb4-93a6-47b8-9f23-d2d3b78a5c26	นิติบุคคลอาคารชุด เดอะ คอร์ทยาร์ด เขาใหญ่ ซี	30	The Courtyard Khao Yai C	นิติบุคคลอาคารชุด เดอะ คอร์ทยาร์ด เขาใหญ่ ซี	The Courtyard Khao Yai C	2017-11-20 17:42:22	2018-05-30 14:36:03	\N	\N
77ed83a7-c476-4c10-8878-9f16c819be3f	นิติบุคคลอาคารชุด กัลปพฤกษ์เลควิวขอนแก่น เอ	40	Kanlapapruek Lake View Khon Kaen A	นิติบุคคลอาคารชุด กัลปพฤกษ์เลควิวขอนแก่น เอ	Kanlapapruek Lake View Khon Kaen A	2017-11-20 18:02:29	2018-06-30 10:00:21	\N	\N
c3511400-b087-4ca6-b660-d9b8d9711606	นิติบุคคลอาคารชุด กัลปพฤกษ์เลควิวขอนแก่น ซี	40	Kanlapapruek Lake View Khon Kaen C	นิติบุคคลอาคารชุด กัลปพฤกษ์เลควิวขอนแก่น ซี	Kanlapapruek Lake View Khon Kaen C	2017-11-20 18:14:31	2018-07-06 15:22:39	\N	\N
74f9f737-c8bb-4591-88d0-bdc349e9c429	นิติบุคคลอาคารชุดคอนโดมิเนียมอุตสาหกรรม อาคารไคตัค	12	Condominium Industrial Juristic Person Kaitak	นิติบุคคลอาคารชุดคอนโดมิเนียมอุตสาหกรรม อาคารไคตัค	Condominium Industrial Juristic Person Kaitak	2018-01-12 15:16:03	2018-01-19 19:19:09	\N	\N
9ef745dd-723d-425d-81aa-58bd4f011a4a	บ้านอยู่สบายรวม (โครงการเก่า)	73	Banyusabai (old projects)	บ้านอยู่สบายรวม (โครงการเก่า)	Banyusabai (old projects)	2018-01-15 16:13:35	2018-01-17 14:27:35	\N	\N
79788dfa-8617-4c26-90b8-d19d8c8577fb	นิติบุคคลอาคารชุด พาร์ค คอนโด ดรีม แม่สอด	63	Park Condo Dream Mae Sot Juristic Person	พาร์ค คอนโด ดรีม แม่สอด	Park Condo Dream Mae Sot	2018-01-11 17:54:03	2018-07-08 13:55:05	\N	\N
7ec43443-8c84-4a67-9871-b0f173fbae4d	นิติบุคคลอาคารชุดเลควิวคอนโดมิเนียม อาคารเดอะเลค	12	The Lakeview Condominium Juristic Person The Lake	อาคารชุดเลควิวคอนโดมิเนียม อาคารเดอะเลค	The Lakeview Condominium The Lake	2017-11-20 15:49:28	2018-07-06 15:36:44	\N	\N
8cafa649-6022-4c12-9bd6-0b7374d0c6a1	บ้านอยู่สบายหนองขาหยั่ง	73	Banyusabai Nong kha yang	บ้านอยู่สบายหนองขาหยั่ง	Banyusabai Nong kha yang	2018-01-15 15:58:36	2018-06-06 14:26:11	\N	\N
64b94e67-d515-4007-af1e-220fc8211c35	นิติบุคคลอาคารชุดเลควิวคอนโดมิเนียมอาคารริเวียร่า	12	The Lakeview Condominium Juristic Person Riviera	นิติบุคคลอาคารชุดเลควิวคอนโดมิเนียมอาคารริเวียร่า	The Lakeview Condominium Juristic Person Riviera	2018-01-12 14:39:30	2018-06-15 17:06:25	\N	\N
84bf22b3-4e2a-4ab5-8a8c-52cb72470acc	บ้านอยู่สบาย 8	73	Banyusabai 8	บ้านอยู่สบาย 8	Banyusabai 8	2018-01-15 15:10:34	2018-04-17 17:03:45	\N	\N
78e585a9-7eae-4277-8f47-d60f3a82f306	นิติบุคคลอาคารชุด คอนโดมิเนียมอุตสาหกรรม อาคารนาริตะ	12	Condominium Industrial Juristic Person Narita 	นิติบุคคลอาคารชุด คอนโดมิเนียมอุตสาหกรรม อาคารนาริตะ	Condominium Industrial Juristic Person Narita 	2018-01-12 15:19:38	2018-01-19 19:19:29	\N	\N
d3630fff-2d0a-4f02-be4b-36e0463ad449	หมู่บ้านจัดสรร หมู่บ้านเสริฐศิริ                                	74	Sertsiri Village                                	หมู่บ้านจัดสรร หมู่บ้านเสริฐศิริ                                	Sertsiri Village                                	2018-01-25 23:44:54	2018-01-25 23:44:54	\N	\N
d2afffd1-c6a1-4564-afbb-45f93060c8c3	นิติบุคคลหมู่บ้านจัดสรรปริญสิริ นวมินทร์	10	PRINSIRI NAWAMIN HOUSING JURUSTIC PERSON	ปริญสิริ นวมินทร์	PRINSIRI NAWAMIN	2017-01-27 12:25:17	2018-07-08 11:39:13	\N	\N
6cbc5d29-78ec-46e4-b3c1-dc441c2a570f	นิติบุคคลอาคารชุด วิคตอเรีย คอนโดมีเนียม	12	Victoria Condo	นิติบุคคลอาคารชุด วิคตอเรีย คอนโดมีเนียม	Victoria Condo	2018-01-12 14:52:12	2018-07-07 16:11:07	\N	\N
ef26b787-28b5-4a51-b374-ba8e6818bf04	หมู่บ้านจัดสรร เออร์เบิ้น สาธร มาร์โคโปโล                                	10	URBAN SATHORN (Marcopolo Villa)                                	หมู่บ้านจัดสรร เออร์เบิ้น สาธร มาร์โคโปโล                                	URBAN SATHORN (Marcopolo Villa)                                	2018-01-25 23:36:39	2018-04-10 15:14:30	\N	\N
3454a28a-e291-42e2-b083-6a09d2ec56de	นิติบุคคลอาคารชุด เลควิวคอนโดมิเนียม อาคารเจนีวา	12	The lakeview condominium juristic person geneva	เลควิวคอนโดมิเนียม อาคารเจนีวา	The lakeview condominium geneva	2018-01-12 14:04:03	2018-07-08 13:26:42	\N	\N
0d98dd41-b2f8-4f04-b963-ae9b00ea6cbf	เนนที พร๊อพเพอร์ตี้	50	เนนที พร๊อพเพอร์ตี้	เนนที พร๊อพเพอร์ตี้	เนนที พร๊อพเพอร์ตี้	2017-02-10 11:37:04	2018-02-11 07:08:09	\N	\N
d812897c-0d39-4d5b-a88d-cbd71bbdb1b1	กลุ่มดิจิตอลคัสเตอร์ เชียงใหม่	50	Chiang Mai Digital Cluster	กลุ่มดิจิตอลคัสเตอร์ เชียงใหม่	Chiang Mai Digital Cluster	2018-03-19 14:29:59	2018-03-19 14:29:59	\N	\N
af43534f-f596-4149-8aa2-e80eb2b2e45a	นิติบุคคลหมู่บ้านจัดสรรเติมทรัพย์ลิฟวิ่งโฮม	21	TERMSUB LIVING HOME	หมู่บ้านเติมทรัพย์ลิฟวิ่งโฮม	TERMSUB LIVING HOME	2017-03-03 19:00:31	2018-07-08 14:46:07	\N	\N
2d44e3aa-f826-46c5-b7d7-62da0a4b8d89	กัลปพฤกษ์ แกรนด์ สุราษฎร์ธานี	84	Kalpapruek Grand Suratthani	กัลปพฤกษ์ แกรนด์ สุราษฎร์ธานี	Kalpapruek Grand Suratthani	2018-01-30 20:19:05	2018-07-08 12:49:07	\N	\N
4ad02dbf-6808-449d-bae9-84d0d36297f7	อินดี้ ศรีนครินทร์                                	11	Indy Srinakarin                                	อินดี้ ศรีนครินทร์                                	Indy Srinakarin                                	2018-01-25 23:51:04	2018-06-28 19:37:46	\N	\N
3b6eaa6d-6af8-409d-91fb-cebc5a2416c2	เดอะ ไพร์ม โฮไรซอน	50	THE PRIME HORIZON	เดอะ ไพร์ม โฮไรซอน	THE PRIME HORIZON	2018-01-26 00:16:40	2018-06-21 15:00:58	\N	\N
f2092641-0b2e-4acf-828a-9a341af87936	นิติบุคคลอาคารชุด ปันนาโอเอซิส เรสซิเดนซ์ 2	50	Punna Oasis 2 	นิติบุคคลอาคารชุด ปันนาโอเอซิส เรสซิเดนซ์ 2	Punna Oasis 2 	2018-01-26 00:10:07	2018-07-08 13:42:38	\N	\N
1cb20a42-0580-4379-b4a6-b26df71ac2ad	นิติบุคคลอาคารชุด พาร์ค คอนโด ดรีม นครสวรรค์	60	Park Condo Dream Nakhonsawan	พาร์ค คอนโด ดรีม นครสวรรค์	Park Condo Dream Nakhonsawan	2018-01-30 20:10:45	2018-07-08 15:54:28	\N	\N
08e1f77c-38a9-438d-8996-9254c4203301	นิติบุคคลอาคารชุด เดอะ สตาร์ฮิลล์	50	THE STAR HILL JURISTIC PERSON	เดอะ สตาร์ฮิลล์	THE STAR HILL	2017-06-26 10:46:16	2018-07-07 16:25:55	\N	\N
bfb92cdd-d739-487d-88db-dea2b5bc31ab	อะเมซอน เรสซิเด้นซ์	20	Amazon Residence	อะเมซอน เรสซิเด้นซ์	Amazon Residence	2018-01-12 14:30:10	2018-02-26 17:26:08	\N	\N
a4525a3a-1b8f-488f-aadf-64a65dfa3404	นิติบุคคลอาคารชุด พาร์ค คอนโด ดรีม กาญจนบุรี	71	Park Condo Dream Kanchanaburi Juristic Person	พาร์ค คอนโด ดรีม กาญจนบุรี	Park Condo Dream Kanchanaburi	2017-07-24 10:43:03	2018-07-06 09:01:26	\N	\N
94b7b8ed-cb7f-46e4-bdb5-889cdfb5ac20	นิติบุคคลอาคารชุดทรัมส์คอนโดมิเนียม 1	50	Trams Juristic person	ทรัมส์คอนโดมิเนียม 1	Trams Condominium 1	2017-01-31 00:00:00	2018-07-08 15:23:46	\N	\N
e19119ec-4ac8-4707-8866-6966784ae7bf	ป็อปปูล่า อาคาร T3	12	Popular Building T3	ป็อปปูล่า อาคาร T3	Popular Building T3	2018-04-17 12:10:11	2018-04-17 12:10:11	\N	\N
e7a841e3-f6c0-4247-9e1c-98659f0a86b3	โพรดิจี้ เอ็มอาร์ที บางแค	10	PRODIGY MRT BANGKHAE	โพรดิจี้ เอ็มอาร์ที บางแค	PRODIGY MRT BANGKHAE	2017-10-19 18:09:22	2018-07-08 11:55:54	\N	\N
0b101252-a76f-4ee6-bc28-14e940205932	นิติบุคคล อาคารชุด เมโทรพาร์ค สาทร3-2	10	Metro park sathorn 3-2 Juristic	อาคารชุด เมโทรพาร์ค สาทร3-2	Metro park sathorn 3-2	2018-02-22 13:38:41	2018-02-22 13:38:41	\N	\N
1aec3c7b-4218-403b-ab96-32d402617ddc	หมู่บ้าน NB174	50	Demo NB174	หมู่บ้าน NB174	Demo NB174	2017-10-03 15:25:06	2018-02-09 11:06:46	\N	\N
3122327f-9b5b-40bf-a481-6fc12d54c3f3	เดอะคัลเลอร์ส บางนา-วงแหวน	11	The Colors Premium Bangna - Wongwaen	เดอะคัลเลอร์ส บางนา-วงแหวน	The Colors Premium Bangna - Wongwaen	2018-02-09 01:07:54	2018-02-13 10:33:57	\N	\N
cdd9e423-206a-45a7-8d91-e0a610b4910a	นิติบุคคลหมู่บ้านจัดสรร เดอะวิลเลจ บางนา - วงแหวนฯ	11	The Village Bangna - Wongwan	หมู่บ้านจัดสรร เดอะวิลเลจ บางนา - วงแหวนฯ                                 	The Village Bangna - Wongwan	2018-02-13 11:34:28	2018-02-13 11:34:28	\N	\N
bc3eebe2-0c2b-4eb5-867a-3c81846f4bb4	หมู่บ้าน NB017	50	Demo NB017	หมู่บ้าน NB017	Demo NB017	2017-02-14 13:53:57	2018-03-08 14:46:35	\N	\N
bf9afded-e48c-48c9-9461-867edf92b652	ผู้จัดการนิติบุคคล หมู่บ้านเลควิวปาร์ค 1	50	ผู้จัดการนิติบุคคล หมู่บ้านเลควิวปาร์ค 1	หมู่บ้านเลควิวปาร์ค 1	Lake View Park 1	2017-01-05 14:11:50	2018-03-12 14:54:19	\N	\N
e2ee746a-f654-4dae-9371-0b9068add4c1	เดอะพาร์คแลนด์ ศรีนครินทร์ เลคไซด์	11	The Parkland Srinakarin Lakeside	เดอะพาร์คแลนด์ ศรีนครินทร์ เลคไซด์	The Parkland Srinakarin Lakeside	2018-03-06 09:20:23	2018-03-31 13:55:25	\N	\N
fc5528ae-3e30-4ddd-bb93-e4b0445c3b47	นิติบุคคลหมู่บ้านจัดสรร ชัยพฤกษ์ บางใหญ่ 2	12	Chaiyaphruek Bangyai 2 juristic	หมู่บ้านจัดสรร ชัยพฤกษ์ บางใหญ่ 2	Chaiyapruk Bangyai 2	2018-02-22 13:22:41	2018-03-17 14:08:43	\N	\N
9c3f1af5-42a3-40cb-a550-423449bbbb05	นิติบุคคลอาคารชุด ศุภาลัย วิสต้า แยกติวานนท์	12	Supalai Vista Tiwanon lntersection Juristic Person	อาคารชุด ศุภาลัย วิสต้า แยกติวานนท์	Supalai Vista Tiwanon lntersection	2018-03-07 09:39:37	2018-07-07 14:25:12	\N	\N
f4530752-1d9a-46f8-a1a2-205dafce11cb	นิติบุคคลหมู่บ้านจัดสรร "โกลเด้น วิลเลจ บางนา - กิ่งแก้ว"	11	Golden Village Bangna - Kingkaew	โกลเด้น วิลเลจ บางนา - กิ่งแก้ว	Golden Village Bangna - Kingkaew	2018-03-13 16:48:21	2018-03-13 16:48:21	\N	\N
221294bb-3c66-435e-b98b-3a0e2ccbde21	หมู่บ้าน NB037	50	Demo NB037	หมู่บ้าน NB037	Demo NB037	2017-04-05 15:29:57	2018-03-24 14:25:40	\N	\N
309fbf4c-224d-4f35-b678-591f2a0f3e9f	ไวซ์ ซิกเนเจอร์	50	Wize Signature	ไวซ์ ซิกเนเจอร์	Wize Signature	2017-10-16 11:31:16	2018-05-22 13:38:23	\N	\N
d275932d-2c39-464d-a2d6-c77696cd7a84	ป็อปปูล่า อาคาร T4	12	Popular Building T4	ป็อปปูล่า อาคาร T4	Popular Building T4	2018-04-17 12:14:12	2018-04-17 12:14:12	\N	\N
85a62a5f-b20d-43d9-a81b-a8548be0d769	หมู่บ้าน NB199	50	Demo NB199	หมู่บ้าน NB199	Demo NB199	2018-06-18 12:59:18	2018-06-18 12:59:18	\N	\N
ce199e9c-a5cf-4d96-b87e-1f4870205302	เดอะแกรนด์พระราม 2 (เอ็กคลูซีฟ ปาร์ค)	74	The Grand Rama 2 (Exclusive Park)	เดอะแกรนด์พระราม 2 (เอ็กคลูซีฟ ปาร์ค)	The Grand Rama 2 (Exclusive Park)	2018-01-26 00:00:17	2018-07-08 11:03:09	\N	\N
231e7e94-d249-48de-a377-09e0ce7c9a69	หมู่บ้าน NB197	50	Demo NB197	หมู่บ้าน NB197	Demo NB197	2018-06-18 12:59:17	2018-06-18 12:59:17	\N	\N
2ee51727-6125-442d-a48a-ecba41852ff1	หมู่บ้าน NB200	50	Demo NB200	หมู่บ้าน NB200	Demo NB200	2018-06-18 12:59:18	2018-06-18 12:59:18	\N	\N
b9f3466b-5b06-449d-9838-8e93d1eed281	หมู่บ้าน NB156	50	Demo NB156	หมู่บ้าน NB156	Demo NB156	2017-10-03 15:23:46	2018-04-15 13:31:08	\N	\N
2f3b0eaf-91f8-487a-9bce-b280f71a00d3	หมู่บ้าน NB198	50	Demo NB198	หมู่บ้าน NB198	Demo NB198	2018-06-18 12:59:17	2018-06-18 12:59:17	\N	\N
9d6d64e6-257b-40ad-908c-8c5b613daa95	หมู่บ้าน NB201	50	Demo NB201	หมู่บ้าน NB201	Demo NB201	2018-06-18 12:59:19	2018-06-18 12:59:19	\N	\N
3f6bd940-dec3-4ac6-ab64-2337afcbe3a1	หมู่บ้าน NB202	50	Demo NB202	หมู่บ้าน NB202	Demo NB202	2018-06-18 12:59:19	2018-06-18 12:59:19	\N	\N
e684436b-d26b-4c15-9305-b6df4fa8d3dc	นิติบุคคลอาคารชุด พาร์ค คอนโด ดรีม นครราชสีมา เอ	30	นิติบุคคล อาคารชุด พาร์ค คอนโด ดรีม นครราชสีมา เอ	พาร์ค คอนโด ดรีม นครราชสีมา เอ	Park Condo Dream Nakhonratchasima	2018-01-12 11:15:31	2018-07-08 10:36:49	\N	\N
9d21f2a0-b671-42ba-b753-6d3d8384818c	ป็อปปูล่า อาคาร T5	12	Popular Building T5	ป็อปปูล่า อาคาร T5	Popular Building T5	2018-04-17 13:03:23	2018-04-17 13:03:23	\N	\N
fc50f025-0075-4b35-82dc-af0746777245	หมู่บ้าน NB203	50	Demo NB203	หมู่บ้าน NB203	Demo NB203	2018-06-18 12:59:20	2018-06-18 12:59:20	\N	\N
5fc82823-0612-4a06-95ef-21b22a78cb95	หมู่บ้าน NB204	50	Demo NB204	หมู่บ้าน NB204	Demo NB204	2018-06-18 12:59:20	2018-06-18 12:59:20	\N	\N
0d56cc58-6883-43f2-80b4-6c8e88fedd03	หมู่บ้าน NB205	50	Demo NB205	หมู่บ้าน NB205	Demo NB205	2018-06-18 12:59:20	2018-06-18 12:59:20	\N	\N
8c162185-cbe1-459a-86ca-145cd2dee1d4	หมู่บ้าน NB206	50	Demo NB206	หมู่บ้าน NB206	Demo NB206	2018-06-18 12:59:21	2018-06-18 12:59:21	\N	\N
ff4055ef-b800-43fb-8f63-a0087fa9ec04	นิติบุคคลหมู่บ้านจัดสรรเนเบอร์โฮม	10	Neighborhome Juristic Person	หมู่บ้านเนเบอร์โฮม	Neighborhome	2017-10-16 10:38:02	2018-07-08 12:38:21	\N	\N
55a5a501-95ec-4693-8550-35736959fc9e	นิติบุคคลอาคารชุด มายฮิป คอนโด 2	50	My Hip Condo 2 Juristic Person	มายฮิป คอนโด 2 : My Hip Condo 2	My Hip Condo 2	2017-11-20 11:13:23	2018-07-08 15:18:51	\N	\N
8ace27b3-d007-4386-920a-ed7557994edd	หมู่บ้าน NB187	50	Demo NB187	หมู่บ้าน NB187	Demo NB187	2018-06-18 12:59:13	2018-06-18 13:05:05	\N	\N
be11d880-8aa0-4d73-ac76-b33f846e68c6	นิติบุคคลอาคารชุด เดอะ เทรเชอร์ 1	50	The Treasure 1 Juristic Person	อาคารชุด เดอะ เทรเชอร์ 1 	Moo 4, T. Nongpakrang,	2017-06-13 14:08:55	2018-07-08 15:58:43	\N	\N
992643fe-be3a-486e-984f-ad8dd9e4d3cf	ป็อปปูล่า อาคาร T6	12	Popular Building T6	ป็อปปูล่า อาคาร T6	Popular Building T6	2018-04-17 13:06:39	2018-04-17 13:06:39	\N	\N
e1ea9362-1527-4f0e-9b43-ae7e72f0ab71	นิติบุคคลอาคารชุดเมโทร พาร์ค สาทร 2-3 และ 2-4	10	juristic person metro park sathorn 2-3 and 2-4	เมโทร พาร์ค สาทร โครงการ 2/2	Metro park sathorn 2/2	2017-05-11 16:33:31	2018-07-08 18:09:44	\N	\N
435f8143-b49f-498c-8227-f622f9c6e6cb	กัลปพฤกษ์ แกรนด์ อุบลราชธานี	34	Kalapapruek Grand Ubon Ratchathani	กัลปพฤกษ์ แกรนด์ อุบลราชธานี	Kalapapruek Grand Ubon Ratchathani	2017-11-09 10:51:06	2018-07-08 14:54:17	\N	\N
48cb2253-d799-4c7c-82a0-d3a6b0575acd	นิติบุคคลหมู่บ้านจัดสรร "โกลเด้น วิลเลจ บางนา - กิ่งแก้ว"	11	Golden Village Bangna - Kingkaew Juristic Person	โกลเด้น วิลเลจ บางนา - กิ่งแก้ว	Golden Village Bangna - Kingkaew	2018-04-25 18:31:36	2018-04-25 18:31:36	\N	\N
f9069789-f10b-443d-af74-1be1ed1ce94d	นิติบุคคลอาคารชุด กัลปพฤกษ์ ซิตี้พลัส สกลนคร B	47	Kallpapruek Cityplus Sakonnakhon Condominium B	นิติบุคคลอาคารชุด กัลปพฤกษ์ ซิตี้พลัส สกลนคร B	Kallpapruek Cityplus Sakonnakhon Condominium B	2018-01-16 13:13:38	2018-07-06 09:42:52	\N	\N
e1888c70-3577-4313-a69c-1f47233db862	นิติบุคคลอาคารชุด บ้านสุขสันต์	10	Baan Sukhsan Juristic Person 	บ้านสุขสันต์	Baan Sukhsan Juristic Person 	2018-04-25 18:42:05	2018-04-27 10:49:31	\N	\N
422d95d9-4e36-4aec-bf71-542c36afdde2	นิติบุคคลอาคารชุดเดอะโคทส์ อาคารบี	10	The Coast Tower B Juristic person	เดอะโคทส์ อาคารบี	The Coast Tower B	2018-04-25 16:58:33	2018-07-07 15:13:45	\N	\N
6eec6ec3-0af0-4790-9454-f570ab054a2a	นิติบุคคลหมู่บ้านจัดสรร พฤกษ์ลดา ท่าข้าม - พระราม 2	10	pruklada-thakham-rama2 Juristic Person	หมู่บ้านจัดสรร พฤกษ์ลดา ท่าข้าม - พระราม 2	pruklada-thakham-rama2	2018-04-01 00:53:28	2018-04-03 10:47:44	\N	\N
3d963b13-8c2e-41c0-8769-1778aff401f5	ป็อปปูล่า อาคาร C7	12	Popular Building C7	ป็อปปูล่า อาคาร C7	Popular Building C7	2018-04-17 11:40:31	2018-04-17 11:40:31	\N	\N
540669c3-a2a7-405f-9f90-3cc974d43fd0	ป็อปปูล่า อาคาร C8	12	Popular Building C8	ป็อปปูล่า อาคาร C8	Popular Building C8	2018-04-17 11:43:54	2018-04-17 11:43:54	\N	\N
541e324b-9acb-4090-b7f2-0e4fbf885e0d	ป็อปปูล่า อาคาร C4	12	Popular Building C4	ป็อปปูล่า อาคาร C4	Popular Building C4	2018-04-17 07:09:50	2018-07-07 15:53:41	\N	\N
cb11c615-ec93-44ba-be65-b5ebac312b33	ป็อปปูล่า อาคาร C1	12	Popular Building C1	ป็อปปูล่า อาคาร C1	Popular Building C1	2018-04-17 06:48:55	2018-04-17 06:48:55	\N	\N
12aff4c6-2578-4087-8ff8-0767b0da4f9a	ป็อปปูล่า อาคาร C2	12	Popular Building C2	ป็อปปูล่า อาคาร C2	Popular Building C2	2018-04-17 06:58:33	2018-04-17 06:58:33	\N	\N
12487c4a-0aa0-4696-a224-3bc62f38a1a9	ป็อปปูล่า อาคาร C3	12	Popular Building C3	ป็อปปูล่า อาคาร C3	Popular Building C3	2018-04-17 07:04:08	2018-04-17 07:04:08	\N	\N
a773c230-0c8b-49e4-9af0-28b145bdd07a	ป็อปปูล่า อาคาร C6	12	Popular Building C6	ป็อปปูล่า อาคาร C6	Popular Building C6	2018-04-17 11:36:10	2018-04-17 11:36:10	\N	\N
f6939aa2-ee4a-4a94-a20c-53309edf9f25	ป็อปปูล่า อาคาร T2	12	Popular Building T2	ป็อปปูล่า อาคาร T2	Popular Building T2	2018-04-17 12:05:51	2018-06-22 13:50:40	\N	\N
800bf8f9-4e4e-411b-80c2-a6a51c30c55b	ป็อปปูล่า อาคาร C9	12	Popular Building C9	ป็อปปูล่า อาคาร C9	Popular Building C9	2018-04-17 11:47:35	2018-04-17 11:47:35	\N	\N
ac277009-7429-411e-97c7-d70130681541	ป็อปปูล่า อาคาร P1	12	Popular Building P1	ป็อปปูล่า อาคาร P1	Popular Building P1	2018-04-17 11:53:03	2018-04-17 11:53:03	\N	\N
9267c31e-5935-4858-9ddd-05e83f7cd8ce	ป็อปปูล่า อาคาร P2	12	Popular Building P2	ป็อปปูล่า อาคาร P2	Popular Building P2	2018-04-17 11:58:07	2018-04-17 11:58:07	\N	\N
627a7181-2d1a-4abe-b99d-7439e7cfeaf2	ป็อปปูล่า อาคาร T1	12	Popular Building T1	ป็อปปูล่า อาคาร T1	Popular Building T1	2018-04-17 12:01:48	2018-04-17 12:01:48	\N	\N
991c1075-2069-45e7-8641-f8153e9f8ee6	นิติบุคคลอาคารชุด พาร์ค คอนโด ดรีม ลำปาง	52	Juristic Person Park Condo Dream Lampang	พาร์ค คอนโด ดรีม ลำปาง	Park Condo Dream Lampang	2018-04-09 10:08:48	2018-07-08 07:37:42	\N	\N
55d39992-b13b-4f94-8b57-9a2f6f645375	ป๊อปปูล่า อาคาร T11	12	Popular Building T11	ป๊อปปูล่า อาคาร T11	Popular Building T11	2018-04-17 14:56:24	2018-04-17 14:56:24	\N	\N
7fe48146-13f6-473f-a501-5c450e7e32c8	ป๊อปปูล่า อาคาร T12	12	Popular Building T12	ป๊อปปูล่า อาคาร T12	Popular Building T12	2018-04-17 15:02:33	2018-04-17 15:02:33	\N	\N
8e78cc2d-3d5a-4bf5-bbd6-68c69468f719	ป็อปปูล่า อาคาร T7	12	Popular Building T7	ป็อปปูล่า อาคาร T7	Popular Building T7	2018-04-17 14:12:19	2018-04-17 14:12:19	\N	\N
43deffa7-5f73-4fec-bd38-4ceb7eeb88a2	ป๊อปปูล่า อาคาร T8	12	Popular Building T8	ป๊อปปูล่า อาคาร T8	Popular Building T8	2018-04-17 14:19:01	2018-04-17 14:19:01	\N	\N
25588bfe-e124-4e35-b26d-81b7589acdbc	ป๊อปปูล่า อาคาร T9	12	Popular Building T9	ป๊อปปูล่า อาคาร T9	Popular Building T9	2018-04-17 14:24:51	2018-04-17 14:24:51	\N	\N
522c5877-594c-4d44-8e8b-d11b39479221	ป๊อปปูล่า อาคาร T10	12	Popular Building T10	ป๊อปปูล่า อาคาร T10	Popular Building T10	2018-04-17 14:50:21	2018-04-17 14:50:21	\N	\N
b60710e3-ed27-411f-b9d4-eeb35bae50b0	นิติบุคคลอาคารชุดเดอะโคส์ท อาคารเอ	10	THE COAST TOWER A JURISTIC PERSON	เดอะโคส์ท อาคารเอ	The Coast Tower A	2018-04-25 16:38:45	2018-06-05 15:16:27	\N	\N
1518c087-784a-4761-b570-a03ae40620d2	นิติบุคคล แกรนด์ โมนาโค เฟส 1	10	Grande Monaco Juristic person	หมู่บ้านจัดสรร แกรนด์ โมนาโค เฟส 1	GRANDE MONACO  Boat & Country Club	2018-04-25 18:10:48	2018-04-27 14:01:46	\N	\N
db0fec76-9095-43ef-b2f2-3384091b5240	นิติบุคคลอาคารชุด กัลปพฤกษ์ ซิตี้พลัส สกลนคร A	47	Kalpapruek Cityplus Sakonnakhon Condominium A	นิติบุคคลอาคารชุด กัลปพฤกษ์ ซิตี้พลัส สกลนคร A	Kalpapruek Cityplus Sakonnakhon Condominium A	2017-11-20 15:38:57	2018-07-06 16:12:20	\N	\N
3df667c7-46bb-43de-8e36-03ca486f5f6f	นิติบุคคลอาคารชุด กัลปพฤกษ์ แกรนด์ พาร์ค เชียงราย	57	Kallapaphruk Grand Park Chiangrai	นิติบุคคลอาคารชุด กัลปพฤกษ์ แกรนด์ พาร์ค เชียงราย	Kallapaphruk Grand Park Chiangrai	2017-11-10 12:49:36	2018-07-08 17:05:36	\N	\N
496d8c3c-62e6-49e8-b98f-2bce4bc93fbf	ซิตี้เซ็นเตอร์ เรสซิเด้นซ์	20	City Center Residence	ซิตี้เซ็นเตอร์ เรสซิเด้นซ์	City Center Residence	2018-01-15 14:18:20	2018-07-04 16:23:19	\N	\N
4ef01c19-ad10-47ea-ada4-41f45c1dc685	ป็อปปูล่าP1 การเงิน	12	PopularP1 Finance	ป็อปปูล่าP1 การเงิน	PopularP1 Finance	2018-05-02 21:18:37	2018-05-02 21:19:02	\N	\N
98f41170-6510-4baa-ba59-465d101abdd9	เลควิวคอนโดมิเนียม อาคารเดอะเลค การเงิน	12	TheLake Finance	เลควิวคอนโดมิเนียม อาคารเดอะเลค การเงิน	TheLake Finance	2018-05-02 09:35:58	2018-05-02 12:14:34	\N	\N
ae91fb7a-5dbe-44cf-8ff9-87706086e79a	ป็อปปูล่าT1 การเงิน	12	PopularT1 Finance	ป็อปปูล่าT1 การเงิน	PopularT1 Finance	2018-05-02 20:14:08	2018-05-02 20:55:28	\N	\N
95d1ca03-bbc5-49bc-ade6-8c35838d511f	ป็อปปูล่าC9 การเงิน	12	PopularC9 Finance	ป็อปปูล่าC9 การเงิน	PopularC9 Finance	2018-05-02 09:29:18	2018-05-11 14:52:14	\N	\N
c68257f1-8ae7-479c-87e8-ec965ce88fb5	นิติบุคคลอาคารชุด พาร์ค คอนโด ดรีม ตรัง	92	Juristic Person Park condo dream trang Codominium	พาร์ค คอนโด ดรีม ตรัง	Park condo dream Trang Codominium	2018-05-14 14:03:41	2018-07-08 13:45:29	\N	\N
2351afd4-2818-43eb-96c6-8569a7edab4e	นิติบุคคลอาคารชุด กัลปพฤกษ์ แกรนด์พาร์ค อุดรธานี	41	Kallaprapruk Grand Park Udonthani	กัลปพฤกษ์ แกรนด์พาร์ค อุดรธานี	Kallaprapruk Grand Park Udonthani	2017-11-20 15:23:23	2018-07-08 16:15:53	\N	\N
a5da9de5-72d6-4377-a342-1129fb10afaf	นิติบุคคลอาคารชุด กัลปพฤกษ์ คอนโดมิเนียม มหาสารคาม บี	44	Kunlapapruek Condominium Maha Sarakham B Juristic Person	กัลปพฤกษ์ คอนโดมิเนียม มหาสารคาม บี	Kunlapapruek Condominium Maha Sarakham B	2018-05-23 10:27:45	2018-07-08 15:09:43	\N	\N
9fa2f740-e646-4088-9815-ca86a69a0155	นิติบุคคลอาคารชุด วอเตอร์เกท พาวิลเลี่ยน	10	Watergate Pavillion Juristic Person	วอเตอร์เกท พาวิลเลี่ยน	Watergate Pavillion	2018-05-17 10:29:55	2018-05-28 13:32:23	\N	\N
50b233a3-55ed-4027-9acc-0101def8926f	นิติบุคคลหมู่บ้านจัดสรร เดอะวิลล่า บางบัวทอง	12	THE VILLA BANGBUATHONG JURISTIC PERSON	เดอะวิลล่า บางบัวทอง	THE VILLA BANGBUATHONG	2018-05-24 14:06:29	2018-07-06 16:06:47	\N	\N
8adea5ab-055b-4273-997f-d36e7bc884f1	นิติบุคคลหมู่บ้านจัดสรร โกลเด้น อเวนิว แจ้งวัฒนะ-ติวานนท์	12	Golden Avenue Chaengwattana - Tiwanon Juristic Person	หมู่บ้านจัดสรร โกลเด้น อเวนิว แจ้งวัฒนะ-ติวานนท์	Golden Avenue Chaengwattana - Tiwanon	2018-05-24 14:16:02	2018-06-07 16:20:18	\N	\N
f7df14cf-11e8-4f9f-9bcd-f869ebea0701	นิติบุคคลบุคคลหมู่บ้านจัดสรร โกลเด้น ทาวน์ ปิ่นเกล้า-จรัญสนิทวงศ์	12	Golden Town Pinklao-Charansanitwong Juristic Person	บ้านจัดสรร โกลเด้น ทาวน์ ปิ่นเกล้า-จรัญสนิทวงศ์	Golden Town Pinklao-Charansanitwong	2018-05-24 17:16:48	2018-09-14 14:30:15	\N	\N
a6f579b3-eee4-4554-948b-a37aeb319639	นิติบุคคลหมู่บ้านจัดสรร สิมิลัน รีฟ	10	Similan Reef Juristic Person	หมู่บ้านจัดสรร สิมิลัน รีฟ	Similan Reef	2018-06-13 16:04:34	2018-06-13 16:04:34	\N	\N
a8f0cccf-3f12-432f-8134-9497bfe641df	หมู่บ้าน NB188	50	Demo NB188	หมู่บ้าน NB188	Demo NB188	2018-06-18 12:59:13	2018-06-18 12:59:13	\N	\N
d271454e-f3e0-4e53-9ffc-ea12ef7d9fae	นิติบุคคลหมู่บ้านจัดสรร สุชารี (ซอยโกสุมรวมใจ 39)	10	Sucharee Donmueang-Chaengwattana-Songprapa Juristic person	หมู่บ้านจัดสรร สุชารี (ซอยโกสุมรวมใจ 39)	Sucharee Donmueang-Chaengwattana-Songprapa	2018-06-12 09:51:29	2018-06-12 10:56:35	\N	\N
bc0c2eb6-d69a-4d8f-a834-78f6a3412216	หมู่บ้าน NB189	50	Demo NB189	หมู่บ้าน NB189	Demo NB189	2018-06-18 12:59:13	2018-06-18 12:59:13	\N	\N
c71d34b1-5d42-4d17-87e9-0508824e3304	นิติบุคคลหมู่บ้านจัดสรร แกรนด์ วิว	10	GRAND VIEW JURISTIC PERSON	หมู่บ้านจัดสรร แกรนด์ วิว	GRAND VIEW	2018-06-12 11:00:06	2018-06-12 11:41:06	\N	\N
b3ba0544-3b40-413e-baf5-bf38910f6500	หมู่บ้าน NB190	50	Demo NB190	หมู่บ้าน NB190	Demo NB190	2018-06-18 12:59:14	2018-06-18 12:59:14	\N	\N
94079795-4586-4b87-86ca-19cc2b0c8dbf	หมู่บ้าน NB195	50	Demo NB195	หมู่บ้าน NB195	Demo NB195	2018-06-18 12:59:16	2018-06-18 12:59:16	\N	\N
962ed835-16f0-45c4-9879-68ec4b0d3e98	หมู่บ้าน NB191	50	Demo NB191	หมู่บ้าน NB191	Demo NB191	2018-06-18 12:59:14	2018-06-18 12:59:14	\N	\N
44f98c66-b7a8-4edd-b83b-446bf3ad36f8	หมู่บ้าน NB192	50	Demo NB192	หมู่บ้าน NB192	Demo NB192	2018-06-18 12:59:15	2018-06-18 12:59:15	\N	\N
5f1a8218-424e-4139-80d6-f5cd34b11ee9	หมู่บ้าน NB193	50	Demo NB193	หมู่บ้าน NB193	Demo NB193	2018-06-18 12:59:15	2018-06-18 12:59:15	\N	\N
ae0c0a68-1b8e-4dfd-9acf-02301cdb83c2	หมู่บ้าน NB194	50	Demo NB194	หมู่บ้าน NB194	Demo NB194	2018-06-18 12:59:16	2018-06-18 12:59:16	\N	\N
cd432db7-73bd-489a-af29-d1bcf570d4c5	หมู่บ้าน NB196	50	Demo NB196	หมู่บ้าน NB196	Demo NB196	2018-06-18 12:59:16	2018-06-18 12:59:16	\N	\N
25a4f4c8-581c-42e6-806a-beb21136c66c	นิติบุคคลอาคารชุดเลควิวคอนโดมิเนียม อาคารสุพีเรียร์	12	The Lakeview Condominium Juristic Person - Superior	นิติบุคคลอาคารชุดเลควิวคอนโดมิเนียม อาคารสุพีเรียร์	The Lakeview Condominium Juristic Person - Superior	2018-01-12 14:55:55	2018-07-07 11:09:15	\N	\N
30e96b36-4f54-49a9-a809-af79a4abe634	นิติบุคคลอาคารชุดเมโทร พาร์ค สาทร 2-3 และ 2-4	10	Demo NB001	เมโทร พาร์ค สาทร โครงการ 2/2 ทดลองใช้	Metro park sathorn 2/2 Demo	2015-01-01 00:00:00	2017-05-19 11:30:39	\N	\N
5f824697-6587-4386-b4ef-9a4c61626c44	นิติบุคคลหมู่บ้านจัดสรรอินนิซิโอ รังสิต คลองสาม	13	inizio 1 rangsit klong 3 Juristic Person	หมู่บ้านจัดสรรอินนิซิโอ รังสิต คลองสาม	Inizio 1 rangsit klong 3	2018-06-29 12:05:10	2018-06-30 22:07:33	\N	\N
62a92f34-cdd4-445f-8d2b-29617f4593bb	หมู่บ้านจัดสรร เดอะ แกรนด์ วงแหวน - ประชาอุทิศ                                	10	THE GRAND Wongwaen - Prachauthit                                	หมู่บ้านจัดสรร เดอะ แกรนด์ วงแหวน - ประชาอุทิศ                                	THE GRAND Wongwaen - Prachauthit                                	2018-01-25 22:48:04	2018-07-03 11:27:42	\N	\N
f45f68d9-169a-45d7-8f48-ed38d6571ade	นิติบุคคลอาคารชุด กัลปพฤกษ์ คอนโดมิเนียม มหาสารคาม เอ	44	Kunlapapruek Condominium Maha Sarakham A Juristic Person	กัลปพฤกษ์ คอนโดมิเนียม มหาสารคาม เอ	Kunlapapruek Condominium Maha Sarakham A	2018-05-23 10:21:27	2018-07-09 19:26:15	\N	\N
1518183e-8e96-463d-83f3-bd8c876df1e1	นิติบุคคลเนนที พรอพเพอตี้	50	Naenatee Property Juristic	เนนที พรอพเพอตี้	Naenatee Property	2015-01-01 00:00:00	2018-09-23 16:02:18	\N	\N
c534dd11-86ee-4bac-83f0-8afd2a58ca4a	นิติบุคคลโครงการ ธนา แอสโทเรีย	10	 Juristic Person Thana Astoria	ธนา แอสโทเรีย	Thana Astoria	2018-03-30 19:06:08	2018-07-10 10:48:45	\N	\N
\.


--
-- Data for Name: quotation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.quotation (id, quotation_code, invalid_date, total_price, total_discount, grand_total_price, remark, sales_id, lead_id, send_email_status, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: quotation_transaction; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.quotation_transaction (id, product_id, quotation_id, product_amount, product_price, product_price_with_vat, product_vat, grand_total_price, created_at, updated_at) FROM stdin;
\.


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_id_seq', 1, false);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, password, email, created_at, updated_at, remember_token, role, profile_pic_name, profile_pic_path, dob, phone, active, lang, gender, deleted) FROM stdin;
7d087f24-a899-4597-9efa-f6a7ccfbac8e	wsadsadsad	$2y$10$VObT732KGkmw0D3Hco7f4e9moczDR44P1VfQgodNrDtATDRBwOgIm	admin@nabour.me	2018-10-09 14:16:38	2018-10-09 14:16:38	d8jVyUyakgBSgphhMrzumPvyuVdZ8nAGDmTnTF9DRwsL7KRk4GMVDK9poV1J	2	\N	\N	\N	858690985	t	th	\N	f
2cb17b78-620f-4a62-9806-84d66d71211d	asdasdasd	$2y$10$gkiibmaJhME9Qs3nK93JgOrK20NG5LeMA2mxOteFSveOdW72T9ExS	asdasasd@sadasdasd.com	2018-11-29 05:50:43	2018-11-29 05:50:43	l111hXXmTj7ALUCstFAARuJs152AdQJYbCh7GRRjCA8xEKgm3Kx0Zitlgt7t	0	\N	\N	\N	\N	t	th	\N	f
\.


--
-- PostgreSQL database dump complete
--

