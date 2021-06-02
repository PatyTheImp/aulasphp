<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3" aria-label="Fourth navbar example">
    <div class="container">
      <a class="navbar-brand" href="<?= URLROOT; ?>"><?= SITENAME; ?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse">

        <ul class="navbar-nav ms-auto">
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="<?= URLROOT; ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URLROOT; ?>/pages/about">About</a>
          </li>
        </ul>

        <ul class="navbar-nav me-auto">
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="<?= URLROOT; ?>/users/register">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URLROOT; ?>/users/">Login</a>
          </li>
        </ul>
        
      </div>
    </div>
</nav>