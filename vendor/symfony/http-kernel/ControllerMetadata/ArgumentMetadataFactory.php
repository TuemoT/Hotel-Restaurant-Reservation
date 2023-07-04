<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\ControllerMetadata;

/**
 * Builds {@see ArgumentMetadata} objects based on the given Controller.
 *
 * @author Iltar van der Berg <kjarli@gmail.com>
 */
final class ArgumentMetadataFactory implements ArgumentMetadataFactoryInterface
{
    public function createArgumentMetadata(string|object|array $controller, \ReflectionFunctionAbstract $reflector = null): array
    {
        $arguments = [];
        $reflector ??= new \ReflectionFunction($controller(...));

<<<<<<< HEAD
<<<<<<< HEAD
        if (\is_array($controller)) {
            $reflection = new \ReflectionMethod($controller[0], $controller[1]);
            $class = $reflection->class;
        } elseif (\is_object($controller) && !$controller instanceof \Closure) {
            $reflection = new \ReflectionMethod($controller, '__invoke');
            $class = $reflection->class;
        } else {
            $reflection = new \ReflectionFunction($controller);
            if ($class = str_contains($reflection->name, '{closure}') ? null : (\PHP_VERSION_ID >= 80111 ? $reflection->getClosureCalledClass() : $reflection->getClosureScopeClass())) {
                $class = $class->name;
            }
        }

        foreach ($reflection->getParameters() as $param) {
=======
        foreach ($reflector->getParameters() as $param) {
>>>>>>> 66597818 ( abdou a faire un poushe)
=======
        foreach ($reflector->getParameters() as $param) {
>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
            $attributes = [];
            foreach ($param->getAttributes() as $reflectionAttribute) {
                if (class_exists($reflectionAttribute->getName())) {
                    $attributes[] = $reflectionAttribute->newInstance();
                }
            }

            $arguments[] = new ArgumentMetadata($param->getName(), $this->getType($param), $param->isVariadic(), $param->isDefaultValueAvailable(), $param->isDefaultValueAvailable() ? $param->getDefaultValue() : null, $param->allowsNull(), $attributes);
        }

        return $arguments;
    }

    /**
     * Returns an associated type to the given parameter if available.
     */
    private function getType(\ReflectionParameter $parameter): ?string
    {
        if (!$type = $parameter->getType()) {
            return null;
        }
        $name = $type instanceof \ReflectionNamedType ? $type->getName() : (string) $type;

        return match (strtolower($name)) {
            'self' => $parameter->getDeclaringClass()?->name,
            'parent' => get_parent_class($parameter->getDeclaringClass()?->name ?? '') ?: null,
            default => $name,
        };
    }
}
