<?php namespace App\Policies;

use App\PlayerEvalutaion;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlayerEvaluationPolicy
{
    use HandlesAuthorization;

    /**
     * [show description]
     * @param  User             $user       [description]
     * @param  PlayerEvalutaion $evaluation [description]
     * @return [type]                       [description]
     */
    public function index(User $user, $player_id)
    {
        return $user->player_id === $player_id;
    }

    /**
     * Determine if the given user can view the given evaluation.
     *
     * @param  User  $user
     * @param  PlayerEvalutaion  $evaluation
     * @return bool
     */
    public function show(User $user, PlayerEvalutaion $evaluation)
    {
       return $user->player_id === $evaluation->player_id;
    }

    /**
     * [update description]
     * @param  User             $user       [description]
     * @param  PlayerEvalutaion $evaluation [description]
     * @return [type]                       [description]
     */
    public function update(User $user, PlayerEvalutaion $evaluation)
    {
        return $user->player_id === $evaluation->player_id;
    }


    /**
     * [edit description]
     * @param  User             $user       [description]
     * @param  PlayerEvalutaion $evaluation [description]
     * @return [type]                       [description]
     */
    public function edit(User $user, PlayerEvalutaion $evaluation)
    {
        return $user->player_id === $evaluation->player_id;
    }

    /**
     * [create description]
     * @param  User             $user       [description]
     * @param  PlayerEvalutaion $evaluation [description]
     * @return [type]                       [description]
     */
    public function create(User $user, PlayerEvalutaion $evaluation)
    {
        return $user->player_id === $evaluation->player_id;
    }

    /**
     * [destroy description]
     * @param  User             $user       [description]
     * @param  PlayerEvalutaion $evaluation [description]
     * @return [type]                       [description]
     */
    public function destroy(User $user, PlayerEvalutaion $evaluation)
    {
        return $user->player_id === $evaluation->player_id;
    }
}