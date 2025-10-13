<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel Administrativo - Aurora Viagens</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-purple: #8B5CF6;
      --primary-dark: #7C3AED;
      --primary-darker: #6D28D9;
      --primary-light: #A78BFA;
      --primary-lighter: #C4B5FD;
      --black-bg: #0F0F0F;
      --dark-bg: #1A1A1A;
      --darker-bg: #141414;
      --card-bg: #242424;
      --card-border: #333333;
      --text-light: #F8FAFC;
      --text-muted: #94A3B8;
      --text-dark: #1E293B;
      --success: #10B981;
      --warning: #F59E0B;
      --danger: #EF4444;
      --gradient-primary: linear-gradient(135deg, var(--primary-purple) 0%, var(--primary-darker) 100%);
      --gradient-dark: linear-gradient(135deg, var(--dark-bg) 0%, var(--darker-bg) 100%);
      --gradient-card: linear-gradient(145deg, var(--card-bg) 0%, #2D2D2D 100%);
      --shadow-glow: 0 0 20px rgba(139, 92, 246, 0.3);
      --shadow-card: 0 10px 30px rgba(0, 0, 0, 0.4);
      --shadow-hover: 0 15px 40px rgba(0, 0, 0, 0.6);
      --border-radius: 16px;
      --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      background: var(--gradient-dark);
      color: var(--text-light);
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
      padding: 20px 0;
      position: relative;
      overflow-x: hidden;
    }
    
    body::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: 
        radial-gradient(circle at 20% 80%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(124, 58, 237, 0.1) 0%, transparent 50%);
      z-index: -1;
    }
    
    .admin-container {
      max-width: 800px;
      margin: 0 auto;
      padding: 0 20px;
    }
    
    .admin-header {
      text-align: center;
      margin-bottom: 40px;
      position: relative;
    }
    
    .admin-header::after {
      content: '';
      position: absolute;
      bottom: -15px;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 3px;
      background: var(--gradient-primary);
      border-radius: 2px;
    }
    
    .admin-header h1 {
      font-weight: 800;
      margin-bottom: 8px;
      font-size: 2.5rem;
      background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-purple) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-shadow: 0 2px 10px rgba(139, 92, 246, 0.3);
      letter-spacing: -0.5px;
    }
    
    .admin-header p {
      color: var(--text-muted);
      font-weight: 400;
      font-size: 1.1rem;
      letter-spacing: 0.5px;
    }
    
    .card {
      border-radius: var(--border-radius);
      background: var(--gradient-card);
      color: var(--text-light);
      box-shadow: var(--shadow-card);
      border: 1px solid var(--card-border);
      overflow: hidden;
      transition: var(--transition);
      position: relative;
    }
    
    .card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-hover), var(--shadow-glow);
    }
    
    .card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: var(--gradient-primary);
    }
    
    .card-header {
      background: rgba(30, 30, 30, 0.8);
      color: var(--text-light);
      padding: 25px 30px;
      border-bottom: 1px solid var(--card-border);
      backdrop-filter: blur(10px);
    }
    
    .card-header h2 {
      font-weight: 700;
      font-size: 1.5rem;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .card-header h2::before {
      content: '✨';
      font-size: 1.2rem;
    }
    
    .card-body {
      padding: 35px 30px;
      background: rgba(36, 36, 36, 0.6);
    }
    
    .form-label {
      font-weight: 600;
      margin-bottom: 10px;
      color: var(--text-light);
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 0.95rem;
    }
    
    .form-label i {
      color: var(--primary-light);
      width: 16px;
    }
    
    .form-control, .form-select {
      border-radius: 12px;
      padding: 14px 16px;
      border: 1px solid #444;
      background: rgba(30, 30, 30, 0.8);
      color: var(--text-light);
      transition: var(--transition);
      font-size: 0.95rem;
      backdrop-filter: blur(10px);
    }
    
    .form-control::placeholder {
      color: var(--text-muted);
    }
    
    .form-control:focus, .form-select:focus {
      border-color: var(--primary-purple);
      background: rgba(40, 40, 40, 0.9);
      box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2), 0 0 20px rgba(139, 92, 246, 0.1);
      color: var(--text-light);
      transform: translateY(-2px);
    }
    
    .form-text {
      color: var(--text-muted);
      font-size: 0.85rem;
      margin-top: 6px;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    
    .form-text::before {
      content: '💡';
      font-size: 0.8rem;
    }
    
    textarea.form-control {
      resize: vertical;
      min-height: 120px;
      line-height: 1.5;
    }
    
    .btn {
      border-radius: 12px;
      padding: 14px 28px;
      font-weight: 600;
      transition: var(--transition);
      border: none;
      font-size: 0.95rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      position: relative;
      overflow: hidden;
    }
    
    .btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
      transition: var(--transition);
    }
    
    .btn:hover::before {
      left: 100%;
    }
    
    .btn-primary {
      background: var(--gradient-primary);
      color: white;
      box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
    }
    
    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(139, 92, 246, 0.6), var(--shadow-glow);
    }
    
    .btn-outline-secondary {
      background: rgba(255, 255, 255, 0.05);
      color: var(--text-light);
      border: 2px solid #444;
      backdrop-filter: blur(10px);
    }
    
    .btn-outline-secondary:hover {
      background: rgba(255, 255, 255, 0.1);
      border-color: var(--primary-light);
      color: var(--primary-light);
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }
    
    .action-buttons {
      display: flex;
      gap: 15px;
      justify-content: center;
      flex-wrap: wrap;
      margin-top: 30px;
    }
    
    /* File input customizado */
    .file-input-wrapper {
      position: relative;
      overflow: hidden;
    }
    
    .file-input-wrapper input[type="file"] {
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
      width: 100%;
      height: 100%;
      cursor: pointer;
    }
    
    .file-input-custom {
      padding: 14px 16px;
      border: 2px dashed #444;
      border-radius: 12px;
      background: rgba(30, 30, 30, 0.6);
      text-align: center;
      transition: var(--transition);
      cursor: pointer;
    }
    
    .file-input-custom:hover {
      border-color: var(--primary-purple);
      background: rgba(139, 92, 246, 0.05);
    }
    
    .file-input-custom i {
      color: var(--primary-light);
      margin-right: 8px;
    }
    
    /* Loading animation */
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }
    
    .btn-primary:active {
      animation: pulse 0.3s ease;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
      .admin-header h1 {
        font-size: 2rem;
      }
      
      .card-body {
        padding: 25px 20px;
      }
      
      .action-buttons {
        flex-direction: column;
      }
      
      .action-buttons .btn {
        width: 100%;
      }
    }
    
    @media (max-width: 576px) {
      .admin-container {
        padding: 0 15px;
      }
      
      .admin-header h1 {
        font-size: 1.8rem;
      }
      
      .card-header {
        padding: 20px;
      }
      
      .card-body {
        padding: 20px 15px;
      }
      
      .btn {
        padding: 12px 20px;
      }
    }
    
    /* Efeitos especiais */
    .form-group {
      position: relative;
    }
    
    .form-group:focus-within .form-label {
      color: var(--primary-light);
    }
    
    /* Animações de entrada */
    .admin-header, .card {
      animation: slideUp 0.6s ease-out;
    }
    
    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    /* Scrollbar customizada */
    ::-webkit-scrollbar {
      width: 8px;
    }
    
    ::-webkit-scrollbar-track {
      background: var(--dark-bg);
    }
    
    ::-webkit-scrollbar-thumb {
      background: var(--primary-purple);
      border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: var(--primary-dark);
    }
  </style>
</head>
<body>
  <div class="admin-container">
    <div class="admin-header">
      <h1>Aurora Viagens</h1>
      <p>Painel Administrativo</p>
    </div>
    
    <div class="card">
      <div class="card-header">
        <h2 class="h4 mb-0"><i class="fas fa-plus-circle"></i> Adicionar Novo Local</h2>
      </div>
      <div class="card-body">
        <form action="upload.php" method="POST" enctype="multipart/form-data">
          <div class="mb-4">
            <label class="form-label">
              <i class="fas fa-signature"></i>
              Nome do Local
            </label>
            <input type="text" name="nome" class="form-control" placeholder="Digite o nome do local" required>
          </div>
          <div class="mb-4">
            <label class="form-label">
              <i class="fas fa-align-left"></i>
              Descrição
            </label>
            <textarea name="descricao" class="form-control" rows="4" placeholder="Descreva o local..." required></textarea>
          </div>
          <div class="mb-4">
            <label class="form-label">
              <i class="fas fa-tag"></i>
              Tipo
            </label>
            <select name="tipo" class="form-select" required>
              <option value="">Selecione o tipo...</option>
              <option value="Restaurante">🍽️ Restaurante</option>
              <option value="Hotel">🏨 Hotel</option>
              <option value="Turismo">🏞️ Ponto Turístico</option>
              <option value="Agência">🏢 Agência</option>
            </select>
          </div>
          <div class="mb-4">
            <label class="form-label">
              <i class="fas fa-image"></i>
              Imagem
            </label>
            <div class="file-input-wrapper">
              <div class="file-input-custom">
                <i class="fas fa-cloud-upload-alt"></i>
                <span>Selecionar imagem...</span>
              </div>
              <input type="file" name="imagem" class="form-control" accept="image/*" required>
            </div>
            <div class="form-text">Formatos suportados: JPG, PNG, GIF. Tamanho máximo: 5MB.</div>
          </div>
          <div class="action-buttons mt-5">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save"></i>
              Salvar Local
            </button>
            <a href="listar.php" class="btn btn-outline-secondary">
              <i class="fas fa-list"></i>
              Ver Lista de Locais
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Adicionar interatividade ao file input
    document.querySelector('input[type="file"]').addEventListener('change', function(e) {
      const fileName = e.target.files[0]?.name || 'Selecionar imagem...';
      const customText = this.previousElementSibling.querySelector('span');
      customText.textContent = fileName;
      
      if (e.target.files[0]) {
        this.previousElementSibling.style.borderColor = 'var(--primary-purple)';
        this.previousElementSibling.style.background = 'rgba(139, 92, 246, 0.1)';
      }
    });
    
    // Efeito de digitação no título
    document.addEventListener('DOMContentLoaded', function() {
      const title = document.querySelector('.admin-header h1');
      const text = title.textContent;
      title.textContent = '';
      let i = 0;
      
      function typeWriter() {
        if (i < text.length) {
          title.textContent += text.charAt(i);
          i++;
          setTimeout(typeWriter, 100);
        }
      }
      
      setTimeout(typeWriter, 500);
    });
  </script>
</body>
</html>