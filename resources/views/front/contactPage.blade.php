@extends('layouts.front')
@section('title')
    İletişim
@endsection
@section('css')
    <style>
        .contactPage {
            background-color: #101828;
        }

        .contactPage .container {
            padding: 150px 10px 5px;
            color: white;
        }




        h1 {
            text-align: center;
        }

        .contactPage form {
            max-width: 600px;
            text-align: center;
            margin: 20px auto;
        }

        .contactPage input,
        textarea {
            border: 0;
            outline: 0;
            padding: 1em;
            border-radius: 8px;
            display: block;
            width: 100%;
            margin-top: 1em;
            font-family: 'Merriweather', sans-serif;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            resize: none;
        }

        .contactPage input:focus,
        textarea:focus {
            box-shadow: 0 0px 2px rgba(231, 76, 60, 1) !important;
        }

        .contactPage #input-submit {
            color: white;
            background: #e74c3c;
            cursor: pointer;
        }

        .contactPage #input-submit:hover {
            box-shadow: 0 1px 1px 1px rgba(170, 170, 170, 0.6);
        }

        .contactPage textarea {
            height: 126px;
        }

        .contactPage .half {
            float: left;
            width: 48%;
            margin-bottom: 1em;
        }

        .contactPage .right {
            width: 50%;
        }

        .contactPage .left {
            margin-right: 2%;
        }

        @media (max-width: 480px) {
            .contactPage .half {
                width: 100%;
                float: none;
                margin-bottom: 0;
            }
        }

        /* Clearfix */
        .contactPage .cf:before,
        .contactPage .cf:after {
            content: " ";
            display: table;
        }

        .contactPage .cf:after {
            clear: both;
        }
    </style>
@endsection
@section('content')
    <div class="contactPage">
        <div class="container">
            <h1>İletişim Formu</h1>
            <form class="cf">
                <div class="half left cf">
                    <input type="text" id="input-name" placeholder="Name">
                    <input type="email" id="input-email" placeholder="Email address">
                    <input type="text" id="input-subject" placeholder="Subject">
                </div>
                <div class="half right cf">
                    <textarea name="message" type="text" id="input-message" placeholder="Message"></textarea>
                </div>
                <input type="submit" value="Submit" id="input-submit">
            </form>
        </div>
    </div>
@endsection
