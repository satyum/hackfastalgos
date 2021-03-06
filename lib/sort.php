<?HH
/**
 * Hack Fast Algos
 *
 * Implements various sorting algorithms optimized for speed.
 */

namespace HackFastAlgos;

class Sort
{
	/**
	 * SelectionSort sorts a vector in Theta(n^2) time (Quadratic time). This algorithm
	 * may be faster than MergeSort or QuickSort when sorting very small vectors consisting of
	 * around less than 10 elements. If you're sorting larger arrays, consider QuickSort or MergeSort.
	 *
	 * Learn more @link https://en.wikipedia.org/wiki/Selection_sort
	 */
	public static function selectionSort(Vector<int> $vector) : Vector<int>
	{
		$vectorLen = $vector->count();

		// Loop through the vector
		for ($i = 0; $i < $vectorLen; $i++) {

			// Loop through the sub-vector to find any values less than $i, and swap them.
			for ($j = $i+1; $j < $vectorLen; $j++) {

				if (static::compare($vector[$i], $vector[$j]) > 0) {

					$vector = static::swapValues($vector, $i, $j);

				}

			}

		}

		return $vector;
	}

	/**
	 * BubbleSort sorts a vector in quadratic time (Theta(n^2), and is less-efficient than
	 * InsertSort. It's still a well-known algorithm, though WikiPedia claims
	 * (@link https://en.wikipedia.org/wiki/Bubble_sort) that some researchers do not wish to have BubbleSort
	 * as part of the Computer Science curriculum. BubbleSort is part of this library as a benchmark.
	 *
	 * Learn more @link https://en.wikipedia.org/wiki/Bubble_sort
	 */
	public static function bubbleSort(Vector<int> $vector) : Vector<int>
	{
		$sortLen = $vector->count();
		while ($sortLen > 0) {

			$newLen = 0;

			for ($i = 1; $i < $sortLen; $i++) {

				if (static::compare($vector[$i-1], $vector[$i]) > 0) {

					static::swapValues($vector, $i-1, $i);
					$newLen = $i;

				}

			}

			$sortLen = $newLen;

		}

		return $vector;
	}

	/**
	 * InsertSort sorts a vector in quadratic time (Theta(n^2)), though it improves on
	 * SelectionSort. InsertSort is only useful for very small vectors. If you have a larger
	 * vector greater than around 10 elements, then try MergeSort or QuickSort.
	 *
	 * Learn more @link https://en.wikipedia.org/wiki/Insertion_sort
	 */
	public static function insertSort(array $array, int $left = 0, ?int $right = null) : array
	{
		$arrayLen = $right === null ? count($array)-1 : $right;
		for ($i = $left+1; $i <= $arrayLen; $i++) {

			$key = $array[$i];
			$j = $i;

			while ($j > $left) {

				if (static::compare($array[$j-1], $key) <= 0) {
					break;
				}

				$array[$j] = $array[$j-1];
				$j--;

			}

			$array[$j] = $key;

		}

		return $array;
	}

	/**
	 * Learn more @link https://en.wikipedia.org/wiki/Shellsort
	 * Operates in O(n^2) and Omega(n log^2 n) time.
	 */
	public static function shellSort(Vector<int> $vector) : Vector<int>
	{
		$gaps = static::getTokundaGaps($vector);
		while (!$gaps->isEmpty()){

			$gap = $gaps->pop();
			$vectorLen = $vector->count();
			for ($i = $gap; $i < $vectorLen; $i++) {

				$key = $vector[$i];

				for ($j = $i; $j >= $gap && static::compare($vector[$j-$gap], $key) > 0; $j -= $gap) {
		            $vector[$j] = $vector[$j - $gap];
		        }

				$vector[$j] = $key;

			}

		}

		return $vector;
	}

	/**
	 * Heap sort is not a stable sorting method.
	 * Learn more @link https://en.wikipedia.org/wiki/Heapsort
	 */
	public static function heapSort<T>(Vector<T> $vector) : Vector<T>
	{
		$return = Vector{};
		$heap = new DataStructure\Heap();
		$heap->heapify($vector);
		$numItems = $heap->count();
		for ($i = 0; $i < $numItems; $i++) {
			$return[] = $heap->extract();
		}

		return $return;
	}

	/**
	 * Shuffle a vector with the Fisher-Yates shuffle. (It's slow as it uses a
	 * proper entropy source.)
	 *
	 * Runs in Theta(n) time.
	 */
	public static function fyShuffle<T>(Vector<T> $vector) : Vector<T>
	{
		$count = $vector->count();
		for ($i = 0; $i < $count-1; $i++) {

			$random = Cryptography::getRandomNumber($i+1, $count);
			$vector = static::swapValues($vector, $i, $random);

		}

		return $vector;
	}

	private static function swapValues(Vector<int> $vector, int $indexA, int $indexB) : Vector<int>
	{
		$oldA = $vector[$indexA];
		$vector[$indexA] = $vector[$indexB];
		$vector[$indexB] = $oldA;

		return $vector;
	}

	/**
	 * Get the Shell Sort gaps using the Tokunda Algorithm.
	 *
	 * Learn more @link https://en.wikipedia.org/wiki/Shellsort#Gap_sequences
	 */
	private static function getTokundaGaps(Vector<int> $vector) : Vector<int>
	{
		$count = $vector->count();
		$gaps = Vector{};
		$k = 1;
		$gap = 0;
		while ($gap < $count) {
			$gap = (int) ceil((9**$k - 4**$k) / (5*4**($k-1)));
			$k++;
			$gaps[] = $gap;
		}

		return $gaps;
	}

	private static function compare<T>(T $a, T $b) : int
	{
		if ($a > $b) {
			return 1;
		} elseif ($a < $b){
			return -1;
		} else {
			return 0;
		}
	}
}
