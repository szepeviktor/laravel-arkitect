<?php

namespace Mortexa\LaravelArkitect\Rules\Implementing;

use Arkitect\Expression\ForClasses\Implement;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\DSL\ArchRule;
use Arkitect\Rules\Rule;
use Mortexa\LaravelArkitect\Contracts\RuleContract;
use Mortexa\LaravelArkitect\Rules\BaseRule;

class ScopesImplementing extends BaseRule implements RuleContract
{
    public static function rule(): ArchRule
    {
        return Rule::allClasses()
            ->that(new ResideInOneOfTheseNamespaces('App\Models\Scopes'))
            ->should(new Implement('Illuminate\Database\Eloquent\Scope'))
            ->because('we use Laravel framework!');
    }

    public static function path(): string
    {
        return 'app/Models/Scopes';
    }
}