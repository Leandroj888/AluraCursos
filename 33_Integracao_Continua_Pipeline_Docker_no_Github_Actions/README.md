# 1 Rotinas existentes

Permite diversivicar ambiente e versões
```yaML
name: build
  build_33:
    runs-on: ${{ matrix.os }}
    strategy:
      matrix:
        os: ['ubuntu-latest', 'ubuntu-22.04']
```

# 2 Preparando o conatainer

Imagens de SO disponiveis para o GitHub Actions
https://github.com/actions/runner-images