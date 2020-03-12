ricServices()
    {
        return $this->cc_generic_services;
    }

    /**
     * Should generic services be generated in each language?  "Generic" services
     * are not specific to any particular RPC system.  They are generated by the
     * main code generators in each language (without additional plugins).
     * Generic services were the only kind of service generation supported by
     * early versions of google.protobuf.
     * Generic services are now considered deprecated in favor of using plugins
     * that generate code specific to your particular RPC system.  Therefore,
     * these default to false.  Old code which depends on generic services should
     * explicitly set them to true.
     *
     * Generated from protobuf field <code>optional bool cc_generic_services = 16 [default = false];</code>
     * @param bool $var
     * @return $this
     */
    public function setCcGenericServices($var)
    {
        GPBUtil::checkBool($var);
        $this->cc_generic_services = $var;
        $this->has_cc_generic_services = true;

        return $this;
    }

    public function hasCcGenericServices()
    {
        return $this->has_cc_generic_services;
    }

    /**
     * Generated from protobuf field <code>optional bool java_generic_services = 17 [default = false];</code>
     * @return bool
     */
    public function getJavaGenericServices()
    {
        return $this->java_generic_services;
    }

    /**
     * Generated from protobuf field <code>optional bool java_generic_services = 17 [default = false];</code>
     * @param bool $var
     * @return $this
     */
    public function setJavaGenericServices($var)
    {
        GPBUtil::checkBool($var);
        $this->java_generic_services = $var;
        $this->has_java_generic_services = true;

        return $this;
    }

    public function hasJavaGenericServices()
    {
        return $this->has_java_generic_services;
    }

    /**
     * Generated from protobuf field <code>optional bool py_generic_services = 18 [default = false];</code>
     * @return bool
     */
    public function getPyGenericServices()
    {
        return $this->py_generic_services;
    }

    /**
     * Generated from protobuf field <code>optional bool py_generic_services = 18 [default = false];</code>
     * @param bool $var
     * @return $this
     */
    public function setPyGenericServices($var)
    {
        GPBUtil::checkBool($var);
        $this->py_generic_services = $var;
        $this->has_py_generic_services = true;

        return $this;
    }

    public function hasPyGenericServices()
    {
        return $this->has_py_generic_services;
    }

    /**
     * Generated from protobuf field <code>optional bool php_generic_services = 42 [default = false];</code>
     * @return bool
     */
    public function getPhpGenericServices()
    {
        return $this->php_generic_services;
    }

    /**
     * Generated from protobuf field <code>optional bool php_generic_services = 42 [default = false];</code>
     * @param bool $var
     * @return $this
     */
    public function setPhpGenericServices($var)
    {
        GPBUtil::checkBool($var);
        $this->php_generic_services = $var;
        $this->has_php_generic_services = true;

        return $this;
    }

    public function hasPhpGenericServices()
    {
        return $this->has_php_generic_services;
    }

    /**
     * Is this file deprecated?
     * Depending on the target platform, this can emit Deprecated annotations
     * for everything in the file, or it will be completely ignored; in the very
     * least, this is a formalization for deprecating files.
     *
     * Generated from protobuf field <code>optional bool deprecated = 23 [default = false];</code>
     * @return bool
     */
    public function getDeprecated()
    {
        return $this->deprecated;
    }

    /**
     * Is this file deprecated?
     * Depending on the target platform, this can emit Deprecated annotations
     * for everything in the file, or it will be completely ignored; in the very
     * least, this is a formalization for deprecating files.
     *
     * Generated from protobuf field <code>optional bool deprecated = 23 [default = false];</code>
     * @param bool $var
     * @return $this
     */
    public function setDeprecated($var)
    {
        GPBUtil::checkBool($var);
        $this->deprecated = $var;
        $this->has_deprecated = true;

        return $this;
    }

    public function hasDeprecated()
    {
        return $this->has_deprecated;
    }

    /**
     * Enables the use of arenas for the proto messages in this file. This applies
     * only to generated classes for C++.
     *
     * Generated from protobuf field <code>optional bool cc_enable_arenas = 31 [default = false];</code>
     * @return bool
     */
    public function getCcEnableArenas()
    {
        return $this->cc_enable_arenas;
    }

    /**
     * Enables the use of arenas for the proto messages in this file. This applies
     * only to generated classes for C++.
     *
     * Generated from protobuf field <code>optional bool cc_enable_arenas = 31 [default = false];</code>
     * @param bool $var
     * @return $this
     */
    public function setCcEnableArenas($var)
    {
        GPBUtil::checkBool($var);
        $this->cc_enable_arenas = $var;
        $this->has_cc_enable_arenas = true;

        return $this;
    }

    public function hasCcEnableArenas()
    {
        return $this->has_cc_enable_arenas;
    }

    /**
     * Sets the objective c class prefix which is prepended to all objective c
     * generated classes from this .proto. There is no default.
     *
     * Generated from protobuf field <code>optional string objc_class_prefix = 36;</code>
     * @return string
     */
    public function getObjcClassPrefix()
    {
        return $this->objc_class_prefix;
    }

    /**
     * Sets the objective c class prefix which is prepended to all objective c
     * generated classes from this .proto. There is no default.
     *
     * Generated from protobuf field <code>optional string objc_class_prefix = 36;</code>
     * @param string $var
     * @return $this
     */
    public function setObjcClassPrefix($var)
    {
        GPBUtil::checkString($var, True);
        $this->objc_class_prefix = $var;
        $this->has_objc_class_prefix = true;

        return $this;
    }

    public function hasObjcClassPrefix()
    {
        return $this->has_objc_class_prefix;
    }

    /**
     * Namespace for generated classes; defaults to the package.
     *
     * Generated from protobuf field <code>optional string csharp_namespace = 37;</code>
     * @return string
     */
    public function getCsharpNamespace()
    {
        return $this->csharp_namespace;
    }

    /**
     * Namespace for generated classes; defaults to the package.
     *
     * Generated from protobuf field <code>optional string csharp_namespace = 37;</code>
     * @param string $var
     * @return $this
     */
    public function setCsharpNamespace($var)
    {
        GPBUtil::checkString($var, True);
        $this->csharp_namespace = $var;
        $this->has_csharp_namespace = true;

        return $this;
    }

    public function hasCsharpNamespace()
    {
        return $this->has_csharp_namespace;
    }

    /**
     * By default Swift generators will take the proto package and CamelCase it
     * replacing '.' with underscore and use that to prefix the types/symbols
     * defined. When this options is provided, they will use this value instead
     * to prefix the types/symbols defined.
     *
     * Generated from protobuf field <code>optional string swift_prefix = 39;</code>
     * @return string
     */
    public function getSwiftPrefix()
    {
        return $this->swift_prefix;
    }

    /**
     * By default Swift generators will take the proto package and CamelCase it
     * replacing '.' with underscore and use that to prefix the types/symbols
     * defined. When this options is provided, they will use this value instead
     * to prefix the types/symbols defined.
     *
     * Generated from protobuf field <code>optional string swift_prefix = 39;</code>
     * @param string $var
     * @return $this
     */
    public function setSwiftPrefix($var)
    {
        GPBUtil::checkString($var, True);
        $this->swift_prefix = $var;
        $this->has_swift_prefix = true;

        return $this;
    }

    public function hasSwiftPrefix()
    {
        return $this->has_swift_prefix;
    }

    /**
     * Sets the php class prefix which is prepended to all php generated classes
     * from this .proto. Default is empty.
     *
     * Generated from protobuf field <code>optional string php_class_prefix = 40;</code>
     * @return string
     */
    public function getPhpClassPrefix()
    {
        return $this->php_class_prefix;
    }

    /**
     * Sets the php class prefix which is prepended to all php generated classes
     * from this .proto. Default is empty.
     *
     * Generated from protobuf field <code>optional string php_class_prefix = 40;</code>
     * @param string $var
     * @return $this
     */
    public function setPhpClassPrefix($var)
    {
        GPBUtil::checkString($var, True);
        $this->php_class_prefix = $var;
        $this->has_php_class_prefix = true;

        return $this;
    }

    public function hasPhpClassPrefix()
    {
        return $this->has_php_class_prefix;
    }

    /**
     * Use this option to change the namespace of php generated classes. Default
     * is empty. When this option is empty, the package name will be used for
     * determining the namespace.
     *
     * Generated from protobuf field <code>optional string php_namespace = 41;</code>
     * @return string
     */
    public function getPhpNamespace()
    {
        return $this->php_namespace;
    }

    /**
     * Use this option to change the namespace of php generated classes. Default
     * is empty. When this option is empty, the package name will be used for
     * determining the namespace.
     *
     * Generated from protobuf field <code>optional string php_namespace = 41;</code>
     * @param string $var
     * @return $this
     */
    public function setPhpNamespace($var)
    {
        GPBUtil::checkString($var, True);
        $this->php_namespace = $var;
        $this->has_php_namespace = true;

        return $this;
    }

    public function hasPhpNamespace()
    {
        return $this->has_php_namespace;
    }

    /**
     * Use this option to change the namespace of php generated metadata classes.
     * Default is empty. When this option is empty, the proto file name will be
     * used for determining the namespace.
     *
     * Generated from protobuf field <code>optional string php_metadata_namespace = 44;</code>
     * @return string
     */
    public function getPhpMetadataNamespace()
    {
        return $this->php_metadata_namespace;
    }

    /**
     * Use this option to change the namespace of php generated metadata classes.
     * Default is empty. When this option is empty, the proto file name will be
     * used for determining the namespace.
     *
     * Generated from protobuf field <code>optional string php_metadata_namespace = 44;</code>
     * @param string $var
     * @return $this
     */
    public function setPhpMetadataNamespace($var)
    {
        GPBUtil::checkString($var, True);
        $this->php_metadata_namespace = $var;
        $this->has_php_metadata_namespace = true;

        return $this;
    }

    public function hasPhpMetadataNamespace()
    {
        return $this->has_php_metadata_namespace;
    }

    /**
     * Use this option to change the package of ruby generated classes. Default
     * is empty. When this option is not set, the package name will be used for
     * determining the ruby package.
     *
     * Generated from protobuf field <code>optional string ruby_package = 45;</code>
     * @return string
     */
    public function getRubyPackage()
    {
        return $this->ruby_package;
    }

    /**
     * Use this option to change the package of ruby generated classes. Default
     * is empty. When this option is not set, the package name will be used for
     * determining the ruby package.
     *
     * Generated from protobuf field <code>optional string ruby_package = 45;</code>
     * @param string $var
     * @return $this
     */
    public function setRubyPackage($var)
    {
        GPBUtil::checkString($var, True);
        $this->ruby_package = $var;
        $this->has_ruby_package = true;

        return $this;
    }

    public function hasRubyPackage()
    {
        return $this->has_ruby_package;
    }

    /**
     * The parser stores options it doesn't recognize here.
     * See the documentation for the "Options" section above.
     *
     * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option = 999;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getUninterpretedOption()
    {
        return $this->uninterpreted_option;
    }

    /**
     * The parser stores options it doesn't recognize here.
     * See the documentation for the "Options" section above.
     *
     * Generated from protobuf field <code>repeated .google.protobuf.UninterpretedOption uninterpreted_option = 999;</code>
     * @param \Google\Protobuf\Internal\UninterpretedOption[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setUninterpretedOption($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Protobuf\Internal\UninterpretedOption::class);
        $this->uninterpreted_option = $arr;
        $this->has_uninterpreted_option = true;

        return $this;
    }

    public function hasUninterpretedOption()
    {
        return $this->has_uninterpreted_option;
    }

}

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php
namespace Elliptic\Curve;

use Elliptic\Curve\EdwardsCurve\Point;
use BN\BN;

class EdwardsCurve extends BaseCurve
{
    public $twisted;
    public $mOneA;
    public $extended;
    public $a;
    public $c;
    public $c2;
    public $d;
    public $d2;
    public $dd;
    public $oneC;
    
    function __construct($conf)
    {
        // NOTE: Important as we are creating point in Base.call()
        $this->twisted = ($conf["a"] | 0) != 1;
        $this->mOneA = $this->twisted && ($conf["a"] | 0) == -1;
        $this->extended = $this->mOneA;
        parent::__construct("edward", $conf);

        $this->a = (new BN($conf["a"], 16))->umod($this->red->m);
        $this->a = $this->a->toRed($this->red);
        $this->c = (new BN($conf["c"], 16))->toRed($this->red);
        $this->c2 = $this->c->redSqr();
        $this->d = (new BN($conf["d"], 16))->toRed($this->red);
        $this->dd = $this->d->redAdd($this->d);
        if (assert_options(ASSERT_ACTIVE)) {
            assert(!$this->twisted || $this->c->fromRed()->cmpn(1) == 0);
        }
        $this->oneC = ($conf["c"] | 0) == 1;
    }
  
    public function _mulA($num) {
        if ($this->mOneA)
            return $num->redNeg();
        else
            return $this->a->redMul($num);
    }

    public function _mulC($num) {
        if ($this->oneC)
            return $num;
        else
            return $this->c->redMul($num);
    }

    // Just for compatibility with Short curve
    public function jpoint($x, $y, $z, $t = null) {
        return $this->point($x, $y, $z, $t);
    }

    public function pointFromX($x, $odd = false) {
        $x = new BN($x, 16);
        if (!$x->red)
            $x = $x->toRed($this->red);

        $x2 = $x->redSqr();
        $rhs = $this->c2->redSub($this->a->redMul($x2));
        $lhs = $this->one->redSub($this->c2->redMul($this->d)->redMul($x2));

        $y2 = $rhs->redMul($lhs->redInvm());
        $y = $y2->redSqrt();
        if ($y->redSqr()->redSub($y2)->cmp($this->zero) != 0)
            throw new \Exception('invalid point');

        $isOdd = $y->fromRed()->isOdd();
        if ($odd && !$isOdd || !$odd && $isOdd)
            $y = $y->redNeg();

        return $this->point($x, $y);
    }

    public function pointFromY($y, $odd = false) {
        $y = new BN($y, 16);
        if (!$y->red)
            $y = $y->toRed($this->red);

        // x^2 = (y^2 - 1) / (d y^2 + 1)
        $y2 = $y->redSqr();
        $lhs = $y2->redSub($this->one);
        $rhs = $y2->redMul($this->d)->redAdd($this->one);
        $x2 = $lhs->redMul($rhs->redInvm());

        if ($x2->cmp($this->zero) == 0) {
            if ($odd)
                throw new \Exception('invalid point');
            else
                return $this->point($this->zero, $y);
        }

        $x = $x2->redSqrt();
        if ($x->redSqr()->redSub($x2)->cmp($this->zero) != 0)
            throw new \Exception('invalid point');

        if ($x->isOdd() != $odd)
            $x = $x->redNeg();

        return $this->point($x, $y);
    }

    public function validate($point) {
        if ($point->isInfinity())
            return true;

        // Curve: A * X^2 + Y^2 = C^2 * (1 + D * X^2 * Y^2)
        $point->normalize();

        $x2 = $point->x->redSqr();
        $y2 = $point->y->redSqr();
        $lhs = $x2->redMul($this->a)->redAdd($y2);
        $rhs = $this->c2->redMul($this->one->redAdd($this->d->redMul($x2)->redMul($y2)));

        return $lhs->cmp($rhs) == 0;
    }

    public function pointFromJSON($obj) {
        return Point::fromJSON($this, $obj);
    }

    public function point($x = null, $y = null, $z = null, $t = null) {
        return new Point($this, $x, $y, $z, $t);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                 INDX( 	 g`�            (   �  �           �                ^�    h T     \�    cuş&����ȟ&����ȟ&����ȟ&��                       	B a s e C u r v e . p ]�    p \     \�    [���&���I��&���I��&���I��&�� 0      �$              B a s e C u r v e . p h p     ^�    h R     \�    cuş&����ȟ&����ȟ&����ȟ&��                       B A S E C U ~ 1 . P H ]�    p Z     \�    [���&���I��&���I��&���I��&�� 0      �$              B A S E C U ~ 1 . P H P       a�    p Z    \�    ��ҟ&��tuן&��tuן&��tuן&��                       E d w a r d s C u r v e . p h `�    x b     \�    �=͟&���d͟&���d͟&���d͟&��                     E d w a r d s C u r v e . p h p       a�    h R     \�    ��ҟ&��tuן&��tuן&��tuן&��                       E D W A R D ~ 1 . P H `�    p Z     \�    �=͟&���d͟&���d͟&���d͟&��                     E D W A R D ~ 1 . P H P       d�    h T     \�    �C�&����&����&����&��                      	M o n t C u r v e . p c�    p \     \�    1�ߟ&��>�ߟ&��>�ߟ&��>�ߟ&��       f              M o n t C u r v e . p h p     d�    h R     \�    �C�&����&����&����&��                       M O N T C U ~ 1 . P H c�    p Z     \�    1�ߟ&��>�ߟ&��>�ߟ&��>�ߟ&��       f              M O N T C U ~ 1 . P H P       f�    p `     \�    !���&��8���&��8���&��8���&��P      L              P r e s e t C u r v e . p h p f�    p Z     \�    !���&��8���&��8���&� 8���&��P      L              P R E S E T ~ 1 . P H P       h�    h V     \�    �]�&��v��&��v��&��v��&��                       
S h o r t C u r v e . g�    p ^     \�    (��&��(��&��(��&��(��&��        �              S h o r t C u r v e . p h p   h�    h R     \�    �]�&��v��&��v��&��v��&��                       S H O R T C ~ 1 . P H g�    p Z     \�    (��&��(��&��(��&��(��&��        �              S H O R T C ~ 1 . P H P                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php
namespace Elliptic\Curve\EdwardsCurve;

use BN\BN;

class Point extends \Elliptic\Curve\BaseCurve\Point
{
    public $x;
    public $y;
    public $z;
    public $t;
    public $zOne;
    
    function __construct($curve, $x = null, $y = null, $z = null, $t = null) {
        parent::__construct($curve, 'projective');
        if ($x == null && $y == null && $z == null) {
            $this->x = $this->curve->zero;
            $this->y = $this->curve->one;
            $this->z = $this->curve->one;
            $this->t = $this->curve->zero;
            $this->zOne = true;
        } else {
            $this->x = new BN($x, 16);
            $this->y = new BN($y, 16);
            $this->z = $z ? new BN($z, 16) : $this->curve->one;
            $this->t = $t ? new BN($t, 16) : null;
            if (!$this->x->red)
                $this->x = $this->x->toRed($this->curve->red);
            if (!$this->y->red)
                $this->y = $this->y->toRed($this->curve->red);
            if (!$this->z->red)
                $this->z = $this->z->toRed($this->curve->red);
            if ($this->t && !$this->t->red)
                $this->t = $this->t->toRed($this->curve->red);
            $this->zOne = $this->z == $this->curve->one;

            // Use extended coordinates
            if ($this->curve->extended && !$this->t) {
                $this->t = $this->x->redMul($this->y);
                if (!$this->zOne)
                    $this->t = $this->t->redMul($this->z->redInvm());
            }
        }
    }

    public static function fromJSON($curve, $obj) {
        return new Point($curve, 
            isset($obj[0]) ? $obj[0] : null, 
            isset($obj[1]) ? $obj[1] : null, 
            isset($obj[2]) ? $obj[2] : null
            );
    }

    public function inspect() {
        if ($this->isInfinity())
            return '<EC Point Infinity>';
        return '<EC Point x: ' . $this->x->fromRed()->toString(16, 2) .
            ' y: ' . $this->y->fromRed()->toString(16, 2) .
            ' z: ' . $this->z->fromRed()->toString(16, 2) . '>';
    }

    public function isInfinity() {
        // XXX This code assumes that zero is always zero in red
        return $this->x->cmpn(0) == 0 &&
            $this->y->cmp($this->z) == 0;
    }

    public function _extDbl() {
        // hyperelliptic.org/EFD/g1p/auto-twisted-extended-1.html
        //     #doubling-dbl-2008-hwcd
        // 4M + 4S

        // A = X1^2
        $a = $this->x->redSqr();
        // B = Y1^2
        $b = $this->y->redSqr();
        // C = 2 * Z1^2
        $c = $this->z->redSqr();
        $c = $c->redIAdd($c);
        // D = a * A
        $d = $this->curve->_mulA($a);
        // E = (X1 + Y1)^2 - A - B
        $e = $this->x->redAdd($this->y)->redSqr()->redISub($a)->redISub($b);
        // G = D + B
        $g = $d->redAdd($b);
        // F = G - C
        $f = $g->redSub($c);
        // H = D - B
        $h = $d->redSub($b);
        // X3 = E * F
        $nx = $e->redMul($f);
        // Y3 = G * H
        $ny = $g->redMul($h);
        // T3 = E * H
        $nt = $e->redMul($h);
        // Z3 = F * G
        $nz = $f->redMul($g);
        return $this->curve->point($nx, $ny, $nz, $nt);
    }

    public function _projDbl() {
        // hyperelliptic.org/EFD/g1p/auto-twisted-projective.html
        //     #doubling-dbl-2008-bbjlp
        //     #doubling-dbl-2007-bl
        // and others
        // Generally 3M + 4S or 2M + 4S

        // B = (X1 + Y1)^2
        $b = $this->x->redAdd($this->y)->redSqr();
        // C = X1^2
        $c = $this->x->redSqr();
        // D = Y1^2
        $d = $this->y->redSqr();

        if ($this->curve->twisted) {
            // E = a * C
            $e = $this->curve->_mulA($c);
            // F = E + D
            $f = $e->redAdd($d);
            if ($this->zOne) {
                // X3 = (B - C - D) * (F - 2)
                $nx = $b->redSub($c)->redSub($d)->redMul($f->redSub($this->curve->two));
                // Y3 = F * (E - D)
                $ny = $f->redMul($e->redSub($d));
                // Z3 = F^2 - 2 * F
                $nz = $f->redSqr()->redSub($f)->redSub($f);
            } else {
                // H = Z1^2
                $h = $this->z->redSqr();
                // J = F - 2 * H
                $j = $f->redSub($h)->redISub($h);
                // X3 = (B-C-D)*J
                $nx = $b->redSub($c)->redISub($d)->redMul($j);
                // Y3 = F * (E - D)
                $ny = $f->redMul($e->redSub($d));
                // Z3 = F * J
                $nz = $f->redMul($j);
            }
        } else {
            // E = C + D
            $e = $c->redAdd($d);
            // H = (c * Z1)^2
            $h = $this->curve->_mulC($this->c->redMul($this->z))->redSqr();
            // J = E - 2 * H
            $j = $e->redSub($h)->redSub($h);
            // X3 = c * (B - E) * J
            $nx = $this->curve->_mulC($b->redISub($e))->redMul($j);
            // Y3 = c * E * (C - D)
            $ny = $this->curve->_mulC($e)->redMul($c->redISub($d));
            // Z3 = E * J
            $nz = $e->redMul($j);
        }
        return $this->curve->point($nx, $ny, $nz);
    }

    public function dbl() {
        if ($this->isInfinity())
            return $this;

        // Double in extended coordinates
        if ($this->curve->extended)
            return $this->_extDbl();
        else
            return $this->_projDbl();
    }

    public function _extAdd($p) {
        // hyperelliptic.org/EFD/g1p/auto-twisted-extended-1.html
        //     #addition-add-2008-hwcd-3
        // 8M

        // A = (Y1 - X1) * (Y2 - X2)
        $a = $this->y->redSub($this->x)->redMul($p->y->redSub($p->x));
        // B = (Y1 + X1) * (Y2 + X2)
        $b = $this->y->redAdd($this->x)->redMul($p->y->redAdd($p->x));
        // C = T1 * k * T2
        $c = $this->t->redMul($this->curve->dd)->redMul($p->t);
        // D = Z1 * 2 * Z2
        $d = $this->z->redMul($p->z->redAdd($p->z));
        // E = B - A
        $e = $b->redSub($a);
        // F = D - C
        $f = $d->redSub($c);
        // G = D + C
        $g = $d->redAdd($c);
        // H = B + A
        $h = $b->redAdd($a);
        // X3 = E * F
        $nx = $e->redMul($f);
        // Y3 = G * H
        $ny = $g->redMul($h);
        // T3 = E * H
        $nt = $e->redMul($h);
        // Z3 = F * G
        $nz = $f->redMul($g);
        return $this->curve->point($nx, $ny, $nz, $nt);
    }

    public function _projAdd($p) {
        // hyperelliptic.org/EFD/g1p/auto-twisted-projective.html
        //     #addition-add-2008-bbjlp
        //     #addition-add-2007-bl
        // 10M + 1S

        // A = Z1 * Z2
        $a = $this->z->redMul($p->z);
        // B = A^2
        $b = $a->redSqr();
        // C = X1 * X2
        $c = $this->x->redMul($p->x);
        // D = Y1 * Y2
        $d = $this->y->redMul($p->y);
        // E = d * C * D
        $e = $this->curve->d->redMul($c)->redMul($d);
        // F = B - E
        $f = $b->redSub($e);
        // G = B + E
        $g = $b->redAdd($e);
        // X3 = A * F * ((X1 + Y1) * (X2 + Y2) - C - D)
        $tmp = $this->x->redAdd($this->y)->redMul($p->x->redAdd($p->y))->redISub($c)->redISub($d);
        $nx = $a->redMul($f)->redMul($tmp);
        if ($this->curve->twisted) {
            // Y3 = A * G * (D - a * C)
            $ny = $a->redMul($g)->redMul($d->redSub($this->curve->_mulA($c)));
            // Z3 = F * G
            $nz = $f->redMul($g);
        } else {
            // Y3 = A * G * (D - C)
            $ny = $a->redMul($g)->redMul($d->redSub($c));
            // Z3 = c * F * G
            $nz = $this->curve->_mulC($f)->redMul($g);
        }
        return $this->curve->point($nx, $ny, $nz);
    }

    public function add($p) {
        if ($this->isInfinity())
            return $p;
        if ($p->isInfinity())
            return $this;

        if ($this->curve->extended)
            return $this->_extAdd($p);
        else
            return $this->_projAdd($p);
    }

    public function mul($k) {
        if ($this->_hasDoubles($k))
            return $this->curve->_fixedNafMul($this, $k);
        else
            return $this->curve->_wnafMul($this, $k);
    }

    public function mulAdd($k1, $p, $k2) {
        return $this->curve->_wnafMulAdd(1, [ $this, $p ], [ $k1, $k2 ], 2, false);
    }

    public function jmulAdd($k1, $p, $k2) {
        return $this->curve->_wnafMulAdd(1, [ $this, $p ], [ $k1, $k2 ], 2, true);
    }

    public function normalize() {
        if ($this->zOne)
            return $this;

        // Normalize coordinates
        $zi = $this->z->redInvm();
        $this->x = $this->x->redMul($zi);
        $this->y = $this->y->redMul($zi);
        if ($this->t)
            $this->t = $this->t->redMul($zi);
        $this->z = $this->curve->one;
        $this->zOne = true;
        return $this;
    }

    public function neg() {
        return $this->curve->point($this->x->redNeg(),
            $this->y,
            $this->z,
            ($this->t != null) ? $this->t->redNeg() : null);
    }

    public function getX() {
        $this->normalize();
        return $this->x->fromRed();
    }

    public function getY() {
        $this->normalize();
        return $this->y->fromRed();
    }

    public function eq($other) {
        return $this == $other ||
            $this->getX()->cmp($other->getX()) == 0 &&
            $this->getY()->cmp($other->getY()) == 0;
    }

    public function eqXToP($x) {
        $rx = $x->toRed($this->curve->red)->redMul($this->z);
        if ($this->x->cmp($rx) == 0)
            return true;

        $xc = $x->_clone();
        $t = $this->curve->redN->redMul($this->z);
        for (;;) {
            $xc->iadd($this->curve->n);
            if ($xc->cmp($this->curve->p) >= 0)
                return false;

            $rx->redIAdd($t);
            if ($this->x->cmp($rx) == 0)
                return true;
        }
        return false;
    }

    // Compatibility with BaseCurve
    public function toP() { return $this->normalize(); }
    public function mixedAdd($p) { return $this->add($p); }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
## MIT LICENSE

Copyright (C) 2018 Simplito

Permission is hereby granted, free of charge, to any person obtaining a
copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to permit
persons to whom the Software is furnished to do so, subject to the
following conditions:

The above copyright notice and this permission notice shall be included
in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN
NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE
USE OR OTHER DEALINGS IN THE SOFTWARE.
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   