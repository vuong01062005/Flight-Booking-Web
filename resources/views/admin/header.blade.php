<style>
    .header {
        background-color: var(--color_main);
        height: 50px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .header h3 {
        color: #fff;
        margin-left: 20px;
        font-size: 24px;
    }
    .header nav {
        display: flex;
        align-items: center;
        margin-right: 100px;
    }
    .header nav i {
        color: var(--color_2);
        margin-right: 16px;
    }
    .header nav div {
        margin-left: 50px;
    }
    .header nav div p {
        color: #fff;
    }
    .header nav div a {
        color: var(--color_3);
    }
</style>
<header class="header">
    <h3>iDashboard</h3>
    <nav>
        <i class="fa-solid fa-envelope"></i>
        <i class="fa-solid fa-bell"></i>
        <div>
            <p>admin</p>
            <a href="{{ route('logout') }}">Đăng xuất</a>
        </div>
    </nav>
</header>