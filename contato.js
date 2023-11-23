function formatarCPF(cpfInput) {
    let cpf = cpfInput.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos

    if (cpf.length > 11) {
      cpf = cpf.substring(0, 11);
    }

    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona ponto após os primeiros três números
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona ponto após os próximos três números
    cpf = cpf.replace(/(\d{3})(\d{2})$/, '$1-$2'); // Adiciona hífen antes dos dois últimos números

    cpfInput.value = cpf;
  }