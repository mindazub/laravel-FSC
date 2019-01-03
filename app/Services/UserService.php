<?php



declare(strict_types = 1);

namespace App\Services;

use App\User;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /**
     * @return LengthAwarePaginator
     */
    public function getPaginate(): LengthAwarePaginator
    {
        return User::paginate();
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public function create(string $name, string $email, string $password): User
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
    }
}
