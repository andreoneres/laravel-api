<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface RepositoryInterface
{
    public function findOne(int $id): ?Model;
    public function findOneBy(array $criteria): ?Model;
    public function findAll(string $orderBy, int $limit): Collection;
    public function findAllBy(array $criteria, string $orderBy, int $limit): Collection;
    public function count(): int;


}

// /bin - Armazena binários do sistema;
// /boot - Armazena arquivos de inicialização do sistema;
// /dev - Armazena dispositivos do sistema;
// /etc - Armazena arquivos de configuração do sistema;
// /home - Armazena arquivos pessoais dos usuários;
// /lib - Armazena bibliotecas compartilhadas do sistema;
// /media - Armazena dispositivos de armazenamento removíveis;
// /mnt - Armazena dispositivos de armazenamento temporários;
// /opt - Armazena arquivos opcionais do sistema;
// /proc - Armazena informações sobre os processos em execução;
// /root - Armazena arquivos pessoais do usuário root;
// /run - Armazena arquivos de inicialização do sistema;
// /sbin - Armazena binários do sistema;
// /srv - Armazena arquivos de serviços do sistema;
// /sys - Armazena informações sobre os dispositivos do sistema;
// /tmp - Armazena arquivos temporários;
// /usr - Armazena arquivos de usuários;
// /var - Armazena arquivos variáveis do sistema.

