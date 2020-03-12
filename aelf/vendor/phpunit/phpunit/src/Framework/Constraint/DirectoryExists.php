 for which you can call the `getFqsen` method to receive a Value Object that represents the complete FQSEN. So that would be `phpDocumentor\Reflection\Types\Context`.

> Why is the FQSEN wrapped in another object `Object_`?
> 
> The resolve method of the TypeResolver only returns object with the interface `Type` and the FQSEN is a common type that does not represent a Type. Also: in some cases a type can represent an "Untyped Object", meaning that it is an object (signified by the `object` keyword) but does not refer to a specific element using an FQSEN.

Another example is on how to resolve the FQSEN of a method as can be seen with the `@see` tag in the example above. To resolve that you can do the following:

```php
$fqsenResolver = new \phpDocumentor\Reflection\FqsenResolver();
$type = $fqsenResolver->resolve('Classy::otherFunction()', $context);
```

Because Classy is a Class in the current namespace its FQSEN will have the `My\Example` namespace and by calling the `resolve` method of the FQSEN Resolver you will receive an `Fqsen` object that refers to `\My\Example\Classy::otherFunction()`.
                                                                                                                                                                                                                                                                                                      