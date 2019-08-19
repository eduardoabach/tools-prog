

class Rectangle:
    def __init__(self, length, width):
        self.length = length
        self.width = width

    def area(self):
        return self.length * self.width

    def perimeter(self):
        return 2 * self.length + 2 * self.width


class Square(Rectangle):
    def __init__(self, length):
        super().__init__(length, length)


class Cube(Square):
    def surface_area(self):
        face_area = super().area()
        return face_area * 6

    def volume(self):
        face_area = super().area()
        return face_area * self.length

#>>> square = Square(4)
#>>> square.area()
#16

#>>> rectangle = Rectangle(2,4)
#>>> rectangle.area()
#8

#>>> cube = Cube(3)
#>>> cube.surface_area()
#54
#>>> cube.volume()
#27
