<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="{{route('user-brands.index')}}">

    <script src="{{ mix('/js/app.js') }}" defer></script>
</head>
<body>
@inertia
</body>
</html>


<style lang="scss">

    .grid-layout {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        grid-gap: 10px;
        grid-auto-rows: minmax(180px, auto);
        grid-auto-flow: dense;
        padding: 10px;
    }

    .grid-item {
        padding: 1rem;
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
        color: #929796;
        /*background-color: #333;*/
        border-radius: 5px;
        background-color: #424242;
    }

    /*.grid-item :nth-child(odd) {*/
    /*    background-color: #424242;*/
    /*}*/


    .span-2 {
        grid-column-end: span 2;
        grid-row-end: span 2;
    }

    .span-3 {
        grid-column-end: span 3;
        grid-row-end: span 4;
    }


    .cardcopybuttonscontainer {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        width: 100%;
        height: 40px;
        -webkit-box-pack: end;
        -webkit-justify-content: flex-end;
        -ms-flex-pack: end;
        justify-content: flex-end;
        -webkit-box-align: end;
        -webkit-align-items: flex-end;
        -ms-flex-align: end;
        align-items: flex-end;
    }


    .copyhtmlbutton {
        opacity: 0;
        display: flex;
        height: 40px;
        margin-right: 8px;
        padding-right: 16px;
        padding-left: 16px;
        justify-content: center;
        align-items: center;
        border-radius: 4px;
        background-color: rgba(30, 30, 30, 0.8);
        transition: background-color 150ms ease-in-out;
        font-family: Inter, sans-serif;
        color: #fff;
        font-size: 16px;
        line-height: 24px;
        font-weight: 400;
        letter-spacing: 0px;
        text-decoration: none;
    }

    .copycssbutton {
        display: flex;
        height: 40px;
        padding-right: 16px;
        padding-left: 16px;
        justify-content: center;
        align-items: center;
        border-radius: 4px;
        background-color: rgba(30, 30, 30, 0.8);
        opacity: 0;
        transition: background-color 150ms ease-in-out;
        font-family: Inter, sans-serif;
        color: #fff;
        font-size: 16px;
        line-height: 24px;
        font-weight: 400;
        letter-spacing: 0px;
        text-decoration: none;
        opacity: 0;
    }

    .copycssbutton:hover {
        background-color: #1e1e1e;
    }

    .copyhtmlbutton:hover {
        background-color: #1e1e1e;
    }
</style>
