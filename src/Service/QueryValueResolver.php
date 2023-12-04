<?php
namespace App\Resolver;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;


class QueryValueResolver implements ArgumentValueResolverInterface
{
   public function supports(Request $request, ArgumentMetadata $argument): bool
   {
       return 'query' === $argument->getName();
   }

   public function resolve(Request $request, ArgumentMetadata $argument): iterable
   {
       yield $request->query->get('query');
   }
}
