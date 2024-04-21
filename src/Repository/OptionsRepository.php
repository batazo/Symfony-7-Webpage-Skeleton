<?php

namespace App\Repository;

use App\Entity\Options;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Options>
 *
 * @method Options[]|null findAllOptions() 
 */
class OptionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Options::class);
    }

    public function findAllOptions(): array
    {
        $options = $this->createQueryBuilder('o')
            ->select('o.optionkey', 'o.value')
            ->getQuery()
            ->getResult();
    
        $result = [];
        foreach ($options as $option) {
            $result[$option['optionkey']] = $option['value'];
        }
    
        return $result;
    }

    public function findOneBySomeField($value): ?Options
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.optionkey = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findValueByOptionKey($optionKey): ?string
    {
        $option = $this->createQueryBuilder('options')
            ->andWhere('options.optionkey = :optionKey')
            ->setParameter('optionKey', $optionKey)
            ->getQuery()
            ->getOneOrNullResult();

        return $option ? $option->getValue() : null;
    }
}
